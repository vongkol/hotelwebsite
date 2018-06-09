<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class MainMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Main Menu', 'l')){
            return view('permissions.no');
        }
        $data['mainmenus'] = DB::table('main_menus')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('main-menus.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Main Menu', 'i')){
            return view('permissions.no');
        }
        return view('main-menus.create');
    }
    // save
    public function save(Request $r)
    {
        if(!Right::check('Main Menu', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'order_number' => $r->order_number
        );
        $sms = "The new main menu has been created successfully.";
        $sms1 = "Fail to create the new main menu, please check again!";
        $i = DB::table('main_menus')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/main-menu/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/main-menu/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Main Menu', 'd')){
            return view('permissions.no');
        }
        DB::table('main_menus')->where('id', $id)->update(['active'=>0]);
        return redirect('/main-menu');
    }

    public function edit($id)
    {
        if(!Right::check('Main Menu', 'u')){
            return view('permissions.no');
        }
        $data['mainmenu'] = DB::table('main_menus')
            ->where('id',$id)->first();
        return view('main-menus.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Main Menu', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'order_number' => $r->order_number
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('main_menus')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/main-menu/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/main-menu/edit/'.$r->id);
        }
    }
}

