<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class FrontOfferController extends Controller
{
     public function index()
     {
        $data['offers'] = DB::table('offers')
             ->where('active',1)
             ->orderBy('order', 'asc')
             ->paginate(18);
        return view('fronts.pages.offer', $data);
     }
}