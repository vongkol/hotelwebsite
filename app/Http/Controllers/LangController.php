<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;
use Illuminate\Support\Facades\Route;

class LangController extends Controller
{
    // index
    public function index($id)
    {
        Session::put("lang", $id);
        return 1;
    }
}
