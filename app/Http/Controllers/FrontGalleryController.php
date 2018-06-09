<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class FrontGalleryController extends Controller
{
     public function index()
     {
        $data['categories'] = DB::table('categories')
             ->where('active',1)
             ->orderBy('order', 'asc')
             ->get();
        return view('fronts.pages.gallery', $data);
     }
}