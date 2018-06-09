<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class FileManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('File Manager', 'l')){
            return view('permissions.no');
        }
        return view('fm.index');
    }
}
