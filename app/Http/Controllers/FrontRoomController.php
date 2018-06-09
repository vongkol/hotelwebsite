<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class FrontRoomController extends Controller
{
     public function index()
     {
        $data['rooms'] = DB::table('rooms')
             ->where('active',1)
             ->orderBy('order', 'asc')
             ->paginate(12);
        return view('fronts.pages.room', $data);
     }
     public function book($id) {
        $data['room'] = DB::table('rooms')
        ->where('id',$id)
        ->first();

        return view('fronts.pages.room-detail', $data);
     }
}