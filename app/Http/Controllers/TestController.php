<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class TestController extends Controller
{
    public function index()
    {
        $i= Right::check('Student', 'l')?'yes':'no';
        return $i;
    }
}
