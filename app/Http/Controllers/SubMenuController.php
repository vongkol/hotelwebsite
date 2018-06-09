<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class SubMenuController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Sub Menu', 'l')){
            return view('permissions.no');
        }
        $data['sub_menus'] = DB::table('sub_menus')
            ->join('main_menus', 'main_menus.id', '=', 'sub_menus.parent_id')
            ->select('sub_menus.*', 'main_menus.name as parent')
            ->orderBy('sub_menus.id', 'desc')
            ->where('sub_menus.active', 1)
            ->paginate(18);
        return view('sub-menus.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Sub Menu', 'i')){
            return view('permissions.no');
        }
        return view('sub-menus.create');
    }
    // save
    public function save(Request $r)
    {
        if(!Right::check('Sub Menu', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'parent_id' => $r->parent,
            'order_number' => $r->order_number
        );
        $sms = "The new sub menu has been created successfully.";
        $sms1 = "Fail to create the new sub menu, please check again!";
        $i = DB::table('sub_menus')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/sub-menu/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/sub-menu/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Sub Menu', 'd')){
            return view('permissions.no');
        }
        DB::table('sub_menus')->where('id', $id)->update(['active'=>0]);
        return redirect('/sub-menu');
    }

    public function edit($id)
    {
        if(!Right::check('Sub Menu', 'u')){
            return view('permissions.no');
        }
        $data['submenu'] = DB::table('sub_menus')
            ->where('id',$id)->first();
        return view('sub-menus.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Sub Menu', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'parent_id' => $r->parent,
            'order_number' => $r->order_number
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('sub_menus')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/sub-menu/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/sub-menu/edit/'.$r->id);
        }
    }
}

