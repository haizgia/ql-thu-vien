<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class AdminHomeController extends Controller
{
    //

    public function home(Request $request) {
        $users = count(DB::table('users')->get());
        $books = count(DB::table('saches')->get());
        $lending = DB::table('saches')
        ->select(DB::raw('SUM(damuon) as total'))
        ->get();
        // dd($users, $books, $lending[0]->total);
        return view('backend.home', ['users'=>$users, 'books'=>$books, 'lending'=>$lending[0]->total]);
    }
}
