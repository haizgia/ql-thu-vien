<?php

namespace App\Http\Controllers\fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\CRUD\_Sach;
use App\CRUD\_Savebook;

class HomeController extends Controller
{
    //
    function home()
    {
        // dd(Hash::make('01022023'));
        $s = new _Sach();
        $save = new _Savebook();
        $data = $s->getEightNew();
        $data3 = $s->getRecommendedBook();
        $ids = $s->getGoodBook();
        $data2 = array();
        $listsave = [];
        if (Auth::check()) {
            $listsave = $save->getByIdUser(Auth::id());
        }

        if (count($ids) > 0) {
            foreach ($ids as $key => $value) {
                $id = $value['masach'];
                array_push($data2, $s->getById($id));
            }
        }

        return view('fontend.index', compact('data', 'data2', 'data3', 'listsave'));
    }
    //
    function about()
    {
        return view('fontend.about');
    }

    public function recommend()
    {
        $s = new _Sach();
        $save = new _Savebook();
        $data = $s->getListRecommendedBook();
        $title = 'Sách đề cử';
        $listsave = [];
        if (Auth::check()) {
            $listsave = $save->getByIdUser(Auth::id());
        }
        return view('fontend.listbook', compact('data', 'title', 'listsave'));
    }
}
