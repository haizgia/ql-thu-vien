<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CRUD\_Sach;
use App\CRUD\_Chitietsach;
use App\CRUD\_Nganh;
use App\CRUD\_Loai;
use App\CRUD\_Vitri;
use App\Http\Requests\StoreAddBook;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class QuanLySachController extends Controller
{
    //
    // tạo đối tượng
    public function __construct(
        _Sach $sach,
        _Chitietsach $ctsach,
        _Nganh $nganh,
        _Loai $loai,
        _Vitri $vt,
        ){
        $this->sach = $sach;
        $this->ctsach = $ctsach;
        $this->nganh = $nganh;
        $this->loai = $loai;
        $this->vt = $vt;

        $s = $s2 = $s3 = $s4 = '';
        $role = Role::whereNotIn('name', ['Super-Admin'])->get();

        $this->middleware(["role_or_permission:Super-Admin|read books"], ['only'=>['index','detail', 'search']]);
        $this->middleware(["role_or_permission:Super-Admin|create books"], ['only'=>['create','store']]);
        $this->middleware(["role_or_permission:Super-Admin|edit books"], ['only'=>['edit','update']]);
        $this->middleware(["role_or_permission:Super-Admin|delete books"], ['only'=>
        ['delete','deleteMulti','deleteMulti_act','restore','destroy','destroy_multi','restore_multi']]);
    }

    public function fixImage() {

    }
    // GET /ql-sach-danhsach
    public function index(Request $request) {
        // dd($request->user()->hasRole('admin'));
        $data = $this->sach->getNew();
        $title = 'Danh sách sách';
        if ($request->query('ten') != null ) {
            $data = $this->sach->getSearch('ten', $request->query('ten'));
            $title = 'Danh sách sách tìm kiếm theo tên: '.$request->query('ten');
        }else if($request->query('masach') != null){
            $data = $this->sach->getSearch('masach', $request->query('masach'));
            $title = 'Danh sách sách tìm kiếm theo mã sách: '.$request->query('masach');
        }
        $data->withPath(url()->full());
        return view('backend.qlsach.danhsach', ['data'=>$data, 'title' => $title]);
    }

    // GET /detail
    public function detail($id){
        // dd($nganh);
        $data = $this->sach->getById($id);
        // $nganh = $this->nganh->getById($id);
        return view('backend.qlsach.chitiet', ['data'=>$data, 'title' => 'Chi tiết sách']);
    }

    // GET /ql-sach/themsach
    public function create() {
        return view('backend.qlsach.themsach', ['nganh' => $this->nganh->getAll(),
        'loai' => $this->loai->getAll(),
        'vt' => $this->vt->getAll(),]);
    }

    // POST /ql-sach/themsach
    public function store(StoreAddBook $request) {
        // dd($request->all());
        $gethinhanh = '';
        $allRequest  = $request->all();

        if($request->hasFile('hinhanh')){
            $hinhanh = $request->file('hinhanh');
            $gethinhanh = time().'_'.$hinhanh->getClientOriginalName();
            $destinationPath = public_path('img');
            $hinhanh->move($destinationPath, $gethinhanh);
        }

        $dataInsertToSach = array(
            'manganh' => $allRequest['manganh'],
            'maloai' => $allRequest['maloai'],
            'mavt' => $allRequest['mavt'],
            'tinhtrang' => $allRequest['tinhtrang'],
            'soluong' => $allRequest['soluong'],
        );

        // nếu thêm sách thành công thì thêm ct sách
        if ($this->sach->create($dataInsertToSach)) {
            $masach = $this->sach->getOneNew()[0]->masach;

            $display = (boolean)$allRequest['display'];
            $data = [
                'masach' => $masach,
                'ten' => $allRequest['ten'],
                'tacgia' => $allRequest['tacgia'],
                'nxb' => $allRequest['nxb'],
                'mota' => $allRequest['mota'],
                'hinhanh' => $gethinhanh,
                'index' => $allRequest['index'],
                'display' => $display,
                'link-pdf' => $allRequest['link-pdf'],
            ];
            if ($this->ctsach->create($data)) {
                return redirect()->route('sach.index')->with('success', 'Thêm sách thành công');
            }else {
                return redirect()->route('sach.index')->with('err', 'Thêm sách thất bại');
            }
        }
    }

    // GET /id/edit
    public function edit($id){
        $data = $this->sach->getById($id);
        // dd($data['link-pdf']);
        return view('backend.qlsach.suasach', ['nganh' => $this->nganh->getAll(),
        'loai' => $this->loai->getAll(),
        'vt' => $this->vt->getAll(),
        'data'=> $data]);
    }

    // PATCH /id
    public function update(StoreAddBook $request, $id){
        $allRequest  = $request->all();
        $gethinhanh = $allRequest['hinhanhcu'];

        if($request->hasFile('hinhanh')){
            $hinhanh = $request->file('hinhanh');
            $gethinhanh = time().'_'.$hinhanh->getClientOriginalName();
            $destinationPath = public_path('img');
            $hinhanh->move($destinationPath, $gethinhanh);
        }

        $dataUpdateToSach = array(
            'manganh' => $allRequest['manganh'],
            'maloai' => $allRequest['maloai'],
            'mavt' => $allRequest['mavt'],
            'tinhtrang' => $allRequest['tinhtrang'],
            'soluong' => $allRequest['soluong'],
        );

        // nếu sửa sách thành công thì sửa ct sách
        if ($this->sach->update($dataUpdateToSach, $id)) {
            $display = (boolean)$allRequest['display'];
            $data = [
                'ten' => $allRequest['ten'],
                'tacgia' => $allRequest['tacgia'],
                'nxb' => $allRequest['nxb'],
                'mota' => $allRequest['mota'],
                'hinhanh' => $gethinhanh,
                'index' => $allRequest['index'],
                'display' => $display,
                'link-pdf' => $allRequest['link-pdf'],
            ];

            if ($this->ctsach->update($data, $id)) {
                return redirect()->route('sach.index')->with('success', 'Sửa sách thành công');
            }else {
                return redirect()->route('sach.index')->with('err', 'Sửa sách thất bại');
            }
        }else{
            return redirect()->route('sach.index')->with('err', 'Sửa sách thất bại');
        }
    }

    // DELETE /id
    public function delete($id) {
        if ($this->ctsach->delete($id)) {
            if ($this->sach->delete($id)) {
                return redirect()->route('sach.index')->with('success', 'Xoá sách thành công');
            }else {
                return redirect()->route('sach.index')->with('err', 'Xoá sách thất bại');
            }
        }
    }

    // POST /col_name
    // public function search($col_name, $value) {
    //     $data = $this->sach->getSearch($col_name, $allRequest[$col_name]);
    //     return view('backend.qlsach.danhsach', ['data'=>$data, 'title' => 'Danh sách tìm kiếm sách theo "'.$allRequest[$col_name].'"']);
    // }

    public function deleteMulti(Request $request){
        $data = $this->sach->getNew();
        $title = 'Danh sách sách';
        if ($request->query('ten') != null ) {
            $data = $this->sach->getSearch('ten', $request->query('ten'));
            $title = 'Danh sách sách tìm kiếm theo tên: '.$request->query('ten');
        }else if($request->query('masach') != null){
            $data = $this->sach->getSearch('masach', $request->query('masach'));
            $title = 'Danh sách sách tìm kiếm theo mã sách: '.$request->query('masach');
        }
        return view('backend.qlsach.xoasach',  ['data'=>$data, 'title' => $title]);
    }

    public function deleteMulti_act(Request $request){
        if ($request->ids != null) {
            $ids = $request->ids;
            if ($this->ctsach->deleteMulti($ids)) {
                if ($this->sach->deleteMulti($ids)) {
                    return redirect()->route('sach.index')->with('success', 'Xoá sách thành công');
                }else {
                    return redirect()->route('sach.index')->with('err', 'Xoá sách thất bại');
                }
            }
        }
        return redirect()->route('sach.index')->with('err', 'Vui lòng chọn sách để xoá');
    }

    public function restore(Request $request,$id = null)
    {
        if ($id == null) {
            $data = $this->sach->getDelete();
            $title = 'Danh sách sách đã bị xoá';
            if ($request->query('ten') != null ) {
                $data = $this->sach->getSearchDelete('ten', $request->query('ten'));
                $title = 'Danh sách sách đã bị xoá tìm kiếm theo tên: '.$request->query('ten');
            }else if($request->query('masach') != null){
                $data = $this->sach->getSearchDelete('masach', $request->query('masach'));
                $title = 'Danh sách sách đã bị xoá tìm kiếm theo mã sách: '.$request->query('masach');
            }

            return view('backend.qlsach.khoiphuc',['data' => $data, 'title'=> $title]);
        }else {
            if ($this->ctsach->restore($id)) {
                $this->sach->restore($id);
                return redirect()->route('sach.index')->with('success', 'Khôi phục sách thành công');
            }else{
                return redirect()->route('sach.index')->with('err', 'Khôi phục sách thất bại');
            }
        }
    }

    public function destroy($id = null)
    {
        if ($this->ctsach->destroy($id)) {
            if ($this->sach->destroy($id)) {
                return redirect()->route('sach.index')->with('success', 'Xoá sách vĩnh viễn thành công');
            }else {
                return redirect()->route('sach.index')->with('err', 'Xoá sách vĩnh viễn thất bại');
            }
        }
    }

    public function destroy_multi(Request $request){
        if ($request->ids != null) {
            $ids = $request->ids;
            if ($this->ctsach->destroy_multi($ids)) {
                if ($this->sach->destroy_multi($ids)) {
                    return redirect()->route('sach.index')->with('success', 'Xoá sách vĩnh viễn thành công');
                }else {
                    return redirect()->route('sach.index')->with('err', 'Xoá sách vĩnh viễn thất bại');
                }
            }
        }
        return redirect()->route('sach.index')->with('err', 'Vui lòng chọn sách để xoá');
    }

    public function restore_multi(Request $request){
        // dd($request->ids);
        if ($request->ids != null) {
            $ids = $request->ids;
            if ($this->ctsach->restore_multi($ids)) {
                if ($this->sach->restore_multi($ids)) {
                    return redirect()->route('sach.index')->with('success', 'Khôi phục sách thành công');
                }else {
                    return redirect()->route('sach.index')->with('err', 'Khôi phục sách thất bại');
                }
            }
        }
        return redirect()->route('sach.index')->with('err', 'Vui lòng chọn sách để xoá');
    }
}
