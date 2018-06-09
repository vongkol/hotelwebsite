<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $data['categories'] = DB::table('categories')
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(18);
        return view('categories.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Post Category', 'i')){
            return view('permissions.no');
        }
        return view('categories.create');
    }
    // save new category
    public function save(Request $r)
    {
        if(!Right::check('Post Category', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
        );
        $sms = "The new image category has been created successfully.";
        $sms1 = "Fail to create the new image category, please check again!";
        $i = DB::table('categories')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Post Category', 'd')){
            return view('permissions.no');
        }
        DB::table('categories')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/category');
    }

    public function edit($id)
    {
        if(!Right::check('Post Category', 'u')){
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
            ->where('id', $id)
            ->first();
            
        return view('categories.edit', $data);
    }
    public function update(Request $r)
    {
        if(!Right::check('Post Category', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name, 
            'order' => $r->order,
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/category/edit/'.$r->id);
        }
    }
}
