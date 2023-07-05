<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\CRUD\_Sach;
use App\CRUD\_Chitietsach;
use App\CRUD\_Muontra;
use App\CRUD\_Dangkymuon;
use App\Models\User;

use App\Exports\MuonTraExport;
use Maatwebsite\Excel\Facades\Excel;

class QLMTController extends Controller
{
    //
    public function __construct(
        _Sach $sach,
        _Chitietsach $ctsach,
        _Dangkymuon $dkmuon,
        _Muontra $muontra,
        ){
        $this->sach = $sach;
        $this->ctsach = $ctsach;
        $this->dkmuon = $dkmuon;
        $this->muontra = $muontra;
    }

    public function lend_book(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('backend.qlmt.lend-book');
        } else {
            $validated = $request->validate([
                'mssv' => 'required',
                'masach' => 'required',
            ],[
                'mssv.required' => "Vui lòng nhập mã số",
                'masach.required' => "Vui lòng nhập mã sách"
            ]);

            if (!User::find(($request['mssv']))) {
                return redirect()->route('mt.lend_book')->with('error', 'Mã số sinh viên không tồn tại');
            }
            if (!$this->sach->check($request['masach'])) {
                return redirect()->route('mt.lend_book')->with('error', 'Mã sách không tồn tại');
            }

            $tt = $this->sach->getById($request['masach'])['id'];

            if($tt == 2) {
                return redirect()->route('mt.lend_book')->with('error', 'Sách này không được mượn về');
            }

            if ($this->checkLendBook($request['mssv'])) {
                if ($this->checkBook($request['masach'])) {
                    $data = [
                        'mssv' => $request['mssv'],
                        'masach' => $request['masach'],
                        'ngaymuon' => Carbon::now(),
                        'ngayhentra' => Carbon::now()->addDay(14),
                    ];
                    // dd($this->muontra->create($data));
                    if ($result = $this->muontra->create($data)) {
                        $this->sach->updateLendBook($request['masach'], 1);
                        return redirect()->route('mt.lend_book')->with('success', 'Thành công, mã phiếu là: ' . $result['id']);
                    }
                }
                return redirect()->route('mt.lend_book')->with('error', 'Số lượng sách có thể mượn đã hết!');
            }else {
                return redirect()->route('mt.lend_book')->with('error', 'User đã hết danh ngạch mượn sách!');
            }
        }
    }

    public function return_book(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('backend.qlmt.return-book', ['data' => 'test']);
        } else {
            $validated = $request->validate([
                'maphieu' => 'required',
            ],[
                'maphieu.required' => "Vui lòng nhập mã phiếu"
            ]);

            $data = $this->muontra->getById($request['maphieu']);
            // dd($data);

            return view('backend.qlmt.return-book', compact('data'));
        }
    }

    public function checkLendBook($idUser)
    {
        $dk = $this->dkmuon->getByIdUserCheck($idUser);
        $mt = $this->muontra->getByIdUserCheck($idUser);
        // dd($dk, $mt);
        return count($dk) + count($mt) >= 2 ? false : true;
    }

    public function checkBook($masach)
    {
        $dk = $this->dkmuon->getByMasachCheck($masach);
        $mt = $this->muontra->getByMasachCheck($masach);
        $slsach = $this->sach->getById($masach)['soluong'];
        // dd($slsach);
        return count($dk) + count($mt) >= $slsach ? false : true;
    }

    public function listLendBookOnline(Request $request)
    {
        $data = $this->dkmuon->getAll();
        // dd($data);
        $title = 'Danh sách sinh viên đăng ký mượn online';
        if ($request->query('madk') != null ) {
            $data = $this->dkmuon->getSearch('madk', $request->query('madk'));
            $title = 'Danh sách tìm kiếm theo mã đăng ký: '.$request->query('madk');
        }else if($request->query('mssv') != null){
            $data = $this->dkmuon->getSearch('mssv', $request->query('mssv'));
            $title = 'Danh sách sinh viên tìm kiếm theo mã số: '.$request->query('mssv');
        }
        return view('backend.qlmt.ds-onl', compact('data', 'title'));
    }

    public function lended($id = null)
    {
        if ($id != null) {
            $this->dkmuon->updateTrangthai($id, 4);
            $d = $this->dkmuon->getById($id);

            $data = [
                'mssv' => $d['mssv'],
                'masach' => $d['masach'],
                'ngaymuon' => Carbon::now(),
                'ngayhentra' => Carbon::now()->addDay(14),
            ];

            if ($this->muontra->create($data)) {
                return redirect()->route('mt.list_online')->with('success', 'Thành công');
            }
        }
        return redirect()->route('mt.list_online');
    }

    public function violate(Request $request, $id = null)
    {
        if ($id != null) {
            $data = $this->muontra->getById($id);

            if ($request->isMethod('GET')) {
                // dd($data);
                return view('backend.qlmt.violate', compact('data'));
            }

            $validated = $request->validate([
                'ndvipham' => 'required',
                'htxuphat' => 'required',
            ], [
                'ndvipham.required' => 'Vui lòng nhập nội dung vi phạm',
                'htxuphat.required' => 'Vui lòng nhập hình thức xử phạt',
            ]);

            $dataInsert = [
                'maphieu' => $id,
                'ndvipham' => $request['ndvipham'],
                'htxuphat' => $request['htxuphat'],
            ];
            // dd($dataInsert);
            $this->muontra->vipham($id, $dataInsert);
            $this->muontra->updateTrangthai($id, $request['trangthai']);
            return redirect()->route('mt.list_outofdate');
        }
    }

    public function renewal(Request $request, $id = null)
    {
        if ($request->isMethod('GET')) {
            if ($id != null) {
                $data = $this->muontra->getById($id);
                return view('backend.qlmt.renewal', compact('data'));
            }
            return redirect()->route('mt.list_lending');
        }
        $data = $this->muontra->getById($id);
        $newdate = Carbon::create($data['ngayhentra'])->addDay($request['reneweltime']);
        $this->muontra->renewal($id, $newdate);
        return redirect()->route('mt.list_lending')->with('success', 'Gia hạn thành công');
    }

    public function solved(Request $request, $id = null)
    {
        if ($id != null) {
            $this->muontra->updateTrangthai($id, 10);
            return redirect()->route('mt.list_outofdate');
        }
    }

    public function losed(Request $request, $id = null)
    {
        if ($id != null) {
            $data = $this->muontra->getById($id);
            $this->sach->updateLoseBook($data->masach, 1);
            $this->muontra->updateTrangthai($id, 11);
            return redirect()->route('mt.list_outofdate');
        }
    }

    public function refunded(Request $request, $id = null)
    {
        if ($id != null) {
            $data = $this->muontra->getById($id);
            $this->sach->updateLoseBook($data->masach, -1);
            $this->muontra->updateTrangthai($id, 12);
            return redirect()->route('mt.list_outofdate');
        }
    }

    public function returned($id = null)
    {
        if ($id != null) {
            $this->muontra->updateTrangthai($id, 7);
            $data = $this->muontra->getById($id);
            $this->sach->updateLendBook($data->masach, -1);

            return redirect()->route('mt.list_lending')->with('success', 'Thành công');
        }
        return redirect()->route('mt.list_lending');
    }

    public function list_lending(Request $request)
    {
        $data = $this->muontra->getLending();
        // dd($data);
        $title = 'Danh sách sinh viên đang mượn';
        if ($request->query('maphieu') != null ) {
            $data = $this->muontra->getLendingSearch('maphieu', $request->query('maphieu'));
            $title = 'Danh sách tìm kiếm theo mã phiếu: '.$request->query('maphieu');
        }else if($request->query('mssv') != null){
            $data = $this->muontra->getLendingSearch('mssv', $request->query('mssv'));
            $title = 'Danh sách sinh viên tìm kiếm theo mã số: '.$request->query('mssv');
        }

        return view('backend.qlmt.ds-lending', compact('data', 'title'));
    }

    public function list_outofdate(Request $request)
    {
        $data = $this->muontra->getOutOfDate();
        $title = 'Danh sách quá hạn và vi phạm';
        if ($request->query('maphieu') != null ) {
            $data = $this->muontra->getOutOfDateSearch('maphieu', $request->query('maphieu'));
            $title = 'Danh sách tìm kiếm theo mã phiếu: '.$request->query('maphieu');
        }else if($request->query('mssv') != null){
            $data = $this->muontra->getOutOfDateSearch('mssv', $request->query('mssv'));
            $title = 'Danh sách tìm kiếm theo mã số: '.$request->query('mssv');
        }
        // dd($data);

        return view('backend.qlmt.ds-outofdate', compact('data', 'title'));
    }

    public function update(Request $request, $id = null)
    {
        if ($id == null) {
            $data = 'test';
            if ($request->isMethod('GET')) {
                return view('backend.qlmt.update', compact('data'));
            } else {
                $validated = $request->validate([
                    'maphieu' => 'required',
                ],[
                    'maphieu.required' => "Vui lòng nhập mã phiếu"
                ]);

                $data = $this->muontra->getById($request['maphieu']);
                // dd($data);

                return view('backend.qlmt.update', compact('data'));
            }
        }else {
            if ($request->isMethod('GET')) {
                return view('backend.qlmt.update');
            }
        }
    }

    public function exportOutOfDate()
    {
        return Excel::download(new MuonTraExport, 'dsquahanvavipham.xlsx');
    }
}
