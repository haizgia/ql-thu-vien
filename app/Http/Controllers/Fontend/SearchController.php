<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CRUD\_Sach;
use App\CRUD\_Chitietsach;
use App\CRUD\_Nganh;
use App\CRUD\_Loai;
use App\CRUD\_Vitri;

class SearchController extends Controller
{
    //
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
    }

    public function search(Request $request)
    {

        $nganh = $this->nganh->getAll();
        $loai = $this->loai->getAll();
        $title = 'Tìm kiếm chung';
        $type = '';
        $id = '';
        $sapxep = array(
            [
                "value" => "chitietsaches.created_at,desc",
                "name" => 'Mới nhất'
            ],
            [
                "value" => "chitietsaches.created_at,asc",
                "name" => 'Cũ nhất'
            ],
            [
                "value" => "chitietsaches.ten,asc",
                "name" => 'Nhan đề tăng dần'
            ],
            [
                "value" => "chitietsaches.ten,desc",
                "name" => 'Nhan đề giảm dần'
            ],
        );
        $timtheo = array(
            [
                "value" => "ten",
                "name" => 'Nhan đề'
            ],
            [
                "value" => "tacgia",
                "name" => 'Tác giả'
            ],
            [
                "value" => "nxb",
                "name" => 'Nhà xuất bản'
            ],
            [
                "value" => "masach",
                "name" => 'Mã sách'
            ],
        );
        $hienthi = array(3, 6, 12, 24, 36, 48, 60);

        if (!isset($request['submit'])) {
            if ($request->query('type') != null ) {
                $type = $request->query('type');
                $id = $request->query('id');

                if ($type == 'loai') {
                    $title = $this->loai->getById($id)['tenloai'];
                }else if($type == 'nganh') {
                    $title = $this->nganh->getById($id)['tennganh'];
                }
                // dd($title);
            }
            return view('fontend.search.tracuu', compact('nganh', 'loai', 'title', 'sapxep', 'timtheo', 'hienthi', 'type', 'id'));
        } else {
            $sx = $request['sapxep'];
            $sxe = explode(',', $sx);
            // dd($sx);
            $tt = $request['timtheo'];
            $ht = $request['hienthi'];
            $key = $request['key'] == null ? '' : $request['key'];
            $data = $this->sach->search($tt, $key, $ht, $sxe[0], $sxe[1]);

            if ($request->query('type') != null ) {
                $id = $request->query('id');
                $type = $request->query('type');
                if ($type == 'loai') {
                    $title = $this->loai->getById($id)['tenloai'];
                    $table= 'loais.maloai';
                }else if($type == 'nganh') {
                    $title = $this->loai->getById($id)['tenloai'];
                    $table= 'nganhs.manganh';
                }

                $id = $request->query('id');
                $data = $this->sach->searchWithType($tt, $key, $table, $id, $ht, $sxe[0], $sxe[1]);
            }

            $data->withPath(url()->full());
            return view('fontend.search.tracuu', compact('nganh', 'loai', 'title', 'sapxep', 'timtheo',
             'hienthi', 'data', 'tt', 'ht', 'sx' , 'key', 'type', 'id'));
        }
    }

    public function getGoodBook()
    {
        $ids = $this->sach->getGoodBook();
    }

    public function searchName(Request $request)
    {
        $data = [];
        $title = '';

        if ($request->query('ten') != null ) {
            $data = $this->sach->getSearch('ten', $request->query('ten'));
            $data->withPath(url()->current().'?ten='.$request->query('ten'));
            $title = 'Danh sách sách tìm kiếm theo tên: '.$request->query('ten');
        }
        // dd($data);
        return view('fontend.search.ten', ['data'=>$data, 'title' => $title]);
    }

    public function searchMajors(Request $request, $id = null)
    {
        $nganh = $this->nganh->getAll();

        if ($id != null) {
            $getMajors = $this->nganh->getById($id);

            if ($request->query('ten') != null ) {
                $data = $this->sach->getSearchWithMajors($id, $request->query('ten'));
                $data->withPath(url()->current().'?ten='.$request->query('ten'));
                $title = 'Danh sách sách tìm kiếm theo tên: '.$request->query('ten');
            }else {
                $data = $this->sach->getByMajors($id);
                $title = 'Ngành '.$getMajors['tennganh'];
            }
            // dd($data);
            return view('fontend.search.nganh', ['data'=>$data, 'nganh'=>$nganh, 'title' => $title, 'getMajors' => $getMajors]);
        }

        return view('fontend.search.nganh', ['nganh'=>$nganh]);
    }

    public function searchCategory(Request $request, $id = null)
    {
        $dm = $this->loai->getAll();

        if ($id != null) {
            $getCategory = $this->loai->getById($id);

            if ($request->query('ten') != null ) {
                $data = $this->sach->getSearchWithCategory($id, $request->query('ten'));
                $data->withPath(url()->current().'?ten='.$request->query('ten'));
                $title = 'Danh sách sách tìm kiếm theo tên: '.$request->query('ten');
            }else {
                $data = $this->sach->getByCategory($id);
                $title = $getCategory['tenloai'];
            }
            // dd($data);
            return view('fontend.search.danhmuc', ['data'=>$data, 'dm'=>$dm, 'title' => $title, 'getCategory' => $getCategory]);
        }

        return view('fontend.search.danhmuc', ['dm'=>$dm]);
    }
}
