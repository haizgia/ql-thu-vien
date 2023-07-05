<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CRUD\_Sinhvien;
use App\CRUD\_Lop;
use App\CRUD\_User;
use App\Http\Requests\StoreAddSvRequest;
use App\Http\Requests\UpdateAddSvRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use App\Imports\SinhviensImport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class QLSVController extends Controller
{
    //
    // tạo đối tượng
    public function __construct(_Sinhvien $sv, _Lop $lop, _User $user){
        $this->sv = $sv;
        $this->lop = $lop;
        $this->user = $user;
        $this->middleware('role_or_permission:Super-Admin|read users|create users|edit users|delete users',
        ['only'=>['index','detail', 'search']]);
        $this->middleware('role_or_permission:Super-Admin|create users', ['only'=>['create','store']]);
        $this->middleware('role_or_permission:Super-Admin|edit users', ['only'=>['edit','update']]);
        $this->middleware('role_or_permission:Super-Admin|delete users', ['only'=>['delete','deleteMulti','deleteMulti_act']]);
        // import
    }

    // GET /ql-sv-danhsv
    public function index(Request $request) {
        $data = $this->sv->getNew();
        // dd($data[0]);
        $title = 'Danh sách sinh viên';
        if ($request->query('ten') != null ) {
            $data = $this->sv->getSearch('hoten', $request->query('ten'));
            $title = 'Danh sách sinh viên tìm kiếm theo tên: '.$request->query('ten');
        }else if($request->query('mssv') != null){
            $data = $this->sv->getSearch('mssv', $request->query('mssv'));
            $title = 'Danh sách sinh viên tìm kiếm theo mã số: '.$request->query('mssv');
        }
        $data->withPath(url()->full());

        return view('backend.qlsv.danhsach', ['data'=>$data, 'title' => $title]);
    }

    // GET /detail
    public function detail($id){
        $data = $this->sv->getById($id);
        return view('backend.qlsv.chitiet', ['data'=>$data, 'title' => 'Chi tiết sinh viên']);
    }

    // GET /ql-sv/themsv
    public function create() {
        $lop = $this->lop->getAll();
        return view('backend.qlsv.themsv', ['lop' => $lop]);
    }

    // POST /ql-sv/themsv
    public function store(StoreAddSvRequest $request) {
        $allRequest = $request->all();
        $ngayhethan = Carbon::create($allRequest['ngaynhaphoc'])->addYears(2)->format('Y-m-d');
        // dd($allRequest['ngaysinh']);
        $ngaysinh = implode(array_reverse(explode('-', $allRequest['ngaysinh'])));
        // dd(Hash::make("$ngaysinh"));
        $dataInsertTosv = array(
            'mssv' => $allRequest['mssv'],
            'ten' => $allRequest['ten'],
            'malop' => $allRequest['malop'],
            'ngaysinh' => $allRequest['ngaysinh'],
            'gioitinh' => $allRequest['gioitinh'],
            'sdt' => $allRequest['sdt'] ? $allRequest['sdt'] : '',
            'diachi' => $allRequest['diachi'] ? $allRequest['diachi'] : '',
            'ngayhethan' => $ngayhethan,
        );

        // nếu thêm sv thành công thì thêm tài khoản user

        if ($this->sv->create($dataInsertTosv)) {
            $pass = implode(array_reverse(explode('-', $allRequest['ngaysinh'])));
            // dd($pass);
            $data = [
                'id' => $allRequest['mssv'],
                'name' => $allRequest['ten'],
                'password' => Hash::make("$pass"),
            ];
            if ($u = $this->user->create($data)) {
                $u->syncRoles(['user']);
                return redirect()->route('sv.index')->with('success', 'Thêm sinh viên thành công');
            }else {
                return redirect()->route('sv.index')->with('err', 'Thêm sinh viên thất bại');
            }
        }
    }

    // GET /id/edit
    public function edit($id){
        $lop = $this->lop->getAll();
        $data = $this->sv->getById($id);
        $ngaynhaphoc = Carbon::create($data->ngayhethan)->subYears(2)->format('Y-m-d');
        // dd($data);
        return view('backend.qlsv.suasv', ['data'=>$data, 'lop' => $lop, 'ngaynhaphoc' => $ngaynhaphoc]);
    }

    // PATCH /id
    public function update(UpdateAddSvRequest $request, $id) {
        // dd($request->all());
        $allRequest = $request->all();
        $ngayhethan = Carbon::create($allRequest['ngaynhaphoc'])->addYears(2)->format('Y-m-d');
        // dd($allRequest['ngaysinh']);
        $ngaysinh = implode(array_reverse(explode('-', $allRequest['ngaysinh'])));
        // dd(Hash::make("$ngaysinh"));
        $dataInsertTosv = array(
            'ten' => $allRequest['ten'],
            'malop' => $allRequest['malop'],
            'ngaysinh' => $allRequest['ngaysinh'],
            'gioitinh' => $allRequest['gioitinh'],
            'sdt' => $allRequest['sdt'] ? $allRequest['sdt'] : '',
            'diachi' => $allRequest['diachi'] ? $allRequest['diachi'] : '',
            'ngayhethan' => $ngayhethan,
        );

        if ($this->sv->update($dataInsertTosv, $id)) {
            $pass = implode(array_reverse(explode('-', $allRequest['ngaysinh'])));
            $data = [
                'id' => $id,
                'name' => $allRequest['ten'],
                'password' => Hash::make("$pass"),
            ];
            if ($this->user->update($data, $id)) {
                return redirect()->route('sv.index')->with('success', 'Sửa thông tin sinh viên thành công');
            }else {
                return redirect()->route('sv.index')->with('err', 'Sửa thông tin sinh viên thất bại');
            }
        }
    }

    // DELETE /id
    public function delete($id) {
        if ($this->sv->delete($id)) {
            if ($this->user->delete($id)) {
                return redirect()->route('sv.index')->with('success', 'Xoá sinh viên thành công');
            }else {
                return redirect()->route('sv.index')->with('err', 'Xoá sinh viên thất bại');
            }
        }
    }

    public function deleteMulti(Request $request){
        $data = $this->sv->getNew();
        $title = 'Danh sách sinh viên';
        if ($request->query('ten') != null ) {
            $data = $this->sv->getSearch('hoten', $request->query('ten'));
            $title = 'Danh sách sinh viên tìm kiếm theo tên: '.$request->query('ten');
        }else if($request->query('mssv') != null){
            $data = $this->sv->getSearch('mssv', $request->query('mssv'));
            $title = 'Danh sách sinh viên tìm kiếm theo mã số: '.$request->query('mssv');
        }
        return view('backend.qlsv.xoasv',  ['data'=>$data, 'title' => $title]);
    }

    public function deleteMulti_act(Request $request){
        if ($request->ids != null) {
            $ids = $request->ids;
            if ($this->sv->deleteMulti($ids)) {
                if ($this->user->deleteMulti($ids)) {
                    return redirect()->route('sv.index')->with('success', 'Xoá sinh viên thành công');
                }else {
                    return redirect()->route('sv.index')->with('err', 'Xoá sinh viên thất bại');
                }
            }
        }
        return redirect()->route('sv.index')->with('err', 'Vui lòng chọn sinh viên để xoá');
    }

    // POST /col_name
    public function search(Request $request, $col_name) {
        $allRequest  = $request->all();
        $data = $this->sv->getSearch($col_name, $allRequest[$col_name]);
        return view('backend.qlsv.danhsach', ['data'=>$data, 'title' => 'Danh sách tìm kiếm sách']);
    }

    public function import(Request $request)
    {
        $request->validate([
            'user_file' => 'required'
        ],[
            'user_file.required' => 'Bạn chưa chọn file'
        ]);
        $file = $request->file('user_file');

        $importSinhvien = new SinhviensImport();
        // $importUser = new UsersImport();

        try {
            $importSinhvien->import($file);
            // $importUser->import($file);

            if ($importSinhvien->failures()->isNotEmpty()) {
                return back()->withFailures($importSinhvien->failures())->with('success', 'Thêm sinh viên thành công');
            }
            return back()->with('success', 'Thêm sinh viên thành công');
        } catch (\Exception $e) {
            return redirect()->route('sv.create')->with('err', 'k');
        }
    }
}
