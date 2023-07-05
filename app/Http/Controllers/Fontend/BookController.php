<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\CRUD\_Sach;
use App\CRUD\_Chitietsach;
use App\CRUD\_Muontra;
use App\CRUD\_Dangkymuon;
use App\CRUD\_User;
use App\CRUD\_Savebook;
use App\CRUD\_Comment;

class BookController extends Controller
{
    //
    public function __construct(
        _Sach $sach,
        _Chitietsach $ctsach,
        _Dangkymuon $dkmuon,
        _Muontra $muontra,
        _Savebook $save,
        _Comment $cm,
        ){
        $this->sach = $sach;
        $this->ctsach = $ctsach;
        $this->dkmuon = $dkmuon;
        $this->muontra = $muontra;
        $this->save = $save;
        $this->cm = $cm;
    }

    public function detail(Request $request, $id = null, $comment = null)
    {
        if ($id != null) {
            $data = $this->sach->getById($id);
            $flag = false;
            $flag2 = false;
            $commenttab = $comment != null ? true :false;
            $allComment = $this->cm->getById($id);

            if (strpos(url()->current(),"comment") >= 0) {
                $allComment->withPath(url()->current());
            }else {
                $allComment->withPath(url()->current()."/comment");
            }
            $userComment = [];
            // dd($allComment->total());
            if (Auth::check()) {
                $userComment = $this->cm->getByIdUser(Auth::id(), $id);
                $listsave = $this->save->getByIdUser(Auth::id());
                foreach ($listsave as $value) {
                    if ($value['masach'] == $id) {
                        $flag = true;
                    }
                }

                $listdk = $this->dkmuon->getByIdUser($request->user()['id']);
                // dd($listdk);
                foreach ($listdk as $value) {
                    if ($value->masach == $id  && $value['trangthai'] == 3) {
                        $flag2 = $value->madk;
                    }
                }
            }

            return view('fontend.book.detail', compact('data', 'flag', 'flag2', 'commenttab', 'allComment', 'userComment'));
        }else {
            return redirect('/')->with('error', 'Có lỗi xảy ra');
        }
    }

    public function saving(Request $request)
    {
        if (Auth::check()) {
            if ($id != null) {

                $request->session()->has('book.save') ? Session::push("book.save", $id) : session()->put('book.save', [$id]);
                // dd($request->session()->all());
                return redirect()->route('book.detail', $id)->with('success', 'Lưu sách thành công');
            }else {
                return redirect('/')->with('error', 'Có lỗi xảy ra');
            }
        }
        return redirect('/login');
    }

    public function listSave(Request $request)
    {
        if (Auth::check()) {
            $listsave = $this->save->getByIdUser(Auth::id());
            $data = [];
            if ($listsave && count($listsave) > 0) {
                foreach ($listsave as $item) {
                    array_push($data, $this->sach->getById($item['masach']));
                }
            }
            return view('fontend.book.saving', compact('data'));
        }
        return redirect('/login');
    }

    public function save(Request $request, $id = null)
    {
        if (Auth::check()) {
            if ($id != null) {

                try {
                    $this->save->create([
                        'id_user'=>Auth::id(),
                        'masach'=>$id,
                    ]);
                    // $request->session()->has('book.save') ? Session::push("book.save", $id) : session()->put('book.save', [$id]);
                    return redirect()->route('book.detail', $id)->with('success', 'Lưu sách thành công');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->route('book.detail', $id)->with('error', 'Lưu sách không thành công');
                }

            }else {
                return redirect('/')->with('error', 'Có lỗi xảy ra');
            }
        }
        return redirect('/login');
    }

    public function unsave(Request $request, $id = null)
    {
        if (Auth::check()) {
            if ($id != null) {
                $this->save->delete(Auth::id(), $id);
                return redirect()->route('book.detail', $id)->with('success', 'Bỏ lưu sách thành công');
            }else {
                return redirect('/')->with('error', 'Có lỗi xảy ra');
            }
        }
    }

    public function registerLend(Request $request, $id = null)
    {
        if ($id != null) {
            if (!Auth::check()) {
                return redirect()->route('login')->with('warning', 'Để đăng kí mượn bạn phải đăng nhập!');
            }
            $check = $this->checkRegisterBook($request->user()['id']);
            $check2 = $this->checkBook($id);

            if ($check && $check2) {
                $data = $this->sach->getById($id);
                $today = Carbon::now('Asia/Ho_Chi_Minh');

                $ngayhen = Carbon::now()->dayOfWeek == 6 ? $today->addDay(2) : $today->addDay(1);

                // dd(Carbon::now('Asia/Ho_Chi_Minh')->addDay(3)->dayOfWeek);
                return view('fontend.book.lendBook', ['data'=>$data,'ngayhen'=>$ngayhen]);
            }else {
                return $check2 == false
                ? redirect()->route('book.detail', $id)->with('warning', 'Số lượng sách có thể mượn đã hết!')
                : redirect()->route('book.detail', $id)->with('warning', 'Bạn đã hết danh ngạch mượn sách!');
            }
        }else {
            return redirect('/')->with('error', 'Có lỗi xảy ra');
        }
    }

    public function unregisterLend(Request $request, $id = null)
    {
        if ($id != null) {
            $this->dkmuon->updateTrangthai($id, 5);
            $data = $this->dkmuon->getById($id);
            $this->sach->updateLendBook($data->masach, -1);
            return redirect()->route('book.detail', $data->masach)->with('success', 'Huỷ đăng ký mượn thành công');
        }else {
            return redirect('/')->with('error', 'Có lỗi xảy ra');
        }
    }

    public function lend(Request $request)
    {
        if (Auth::check()) {
            $check = $this->checkRegisterBook($request->user()['id']);
            // dd($check);
            if ($check) {
                if ($this->checkBook($request['masach'])) {
                    $dataInsert = [
                        'mssv' => $request->user()['id'],
                        'masach' => $request['masach'],
                        'ngayhen' => $request['ngayhen'],
                    ];

                    if ($this->dkmuon->create($dataInsert)) {
                        $this->sach->updateLendBook($request['masach'], 1);
                        return redirect()->route('book.listLendBook')->with('success', 'Đăng ký mượn thành công');
                    }else{
                        return redirect('/')->with('error', 'Có Lỗi xảy ra');
                    }
                }
                return redirect()->route('book.detail', $request['masach'])->with('warning', 'Số lượng sách có thể mượn đã hết!');
            }else {
                return redirect()->route('book.detail', $request['masach'])->with('warning', 'Bạn không thể đăng ký mượn sách nữa!');
            }
        }else {
            return redirect('/login');
        }
    }

    public function checkRegisterBook($idUser)
    {
        $dk = $this->dkmuon->getByIdUserCheck($idUser);
        $mt = $this->muontra->getByIdUserCheck($idUser);

        return count($dk) + count($mt) >= 2 ? false : true;
    }

    public function checkBook($masach)
    {
        $sach = $this->sach->getById($masach);

        return $sach['damat'] + $sach['damuon'] >= $sach['soluong'] ? false : true;
    }

    public function listLendBook(Request $request)
    {
        if (Auth::check()){
            $data = $this->dkmuon->getByIdUser($request->user()['id']);
            // dd($data);
            return view('fontend.book.dkmuon', ['data'=>$data]);
        }else {
            return redirect('/login');
        }
    }

    public function lending(Request $request)
    {
        if (Auth::check()){
            $data = $this->muontra->getByIdUser($request->user()['id']);
            // dd($data);
            return view('fontend.book.dangmuon', ['data'=>$data]);
        }else {
            return redirect('/login');
        }
    }

    public function comment(Request $request, $id)
    {
        if (Auth::check()){
            $validated = $request->validate([
                'comment' => 'required',
            ],[
                'comment.required' => 'Bạn chưa nhập bình luận',
            ]);

            try {
                $this->cm->create([
                    'id_user'=>Auth::id(),
                    'masach'=>$id,
                    'noidung'=>$request->comment,
                ]);

                return redirect()->route('book.detail', [$id, 'comment'])->with('success', 'Bình luận thành công');
            } catch (\Throwable $th) {
                return redirect()->route('book.detail', $id)->with('error', 'Bình luận không thành công');
            }
        }else {
            return redirect('/login');
        }
    }

    public function commentUpdate(Request $request, $id, $idcm)
    {
        if (Auth::check()){
            $validated = $request->validate([
                'comment' => 'required',
            ],[
                'comment.required' => 'Bạn chưa nhập bình luận',
            ]);

            try {
                $this->cm->update($idcm, [
                    'noidung'=>$request->comment,
                ]);

                return redirect()->route('book.detail', [$id, 'comment'])->with('success', 'Sửa bình luận thành công');
            } catch (\Throwable $th) {
                return redirect()->route('book.detail', $id)->with('error', 'Sửa bình luận không thành công');
            }
        }else {
            return redirect('/login');
        }
    }

    public function commentDelete(Request $request, $id, $idcm)
    {
        if (Auth::check()){
            try {
                $this->cm->delete($idcm);

                return redirect()->route('book.detail', [$id, 'comment'])->with('success', 'xoá bình luận thành công');
            } catch (\Throwable $th) {
                return redirect()->route('book.detail', $id)->with('error', 'xoá bình luận không thành công');
            }
        }else {
            return redirect('/login');
        }
    }
}
