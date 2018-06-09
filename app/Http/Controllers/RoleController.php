<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Role', 'l'))
        {
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')->get();
        return view('roles.index', $data);
    }
    public function create()
    {
        if(!Right::check('Role', 'i'))
        {
            return view('permissions.no');
        }
        return view('roles.create');
    }
    public function save(Request $r)
    {
        if(!Right::check('Role', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name
        );
        $i=DB::table('roles')->insert($data);
        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $r->session()->flash('sms',"តួនាទីថ្មីត្រូវបានបង្កើតដោយជោគជ័យ។");
            return redirect('/role/create');
        }
        $r->session()->flash('sms',"New role has been created successfully.");
        return redirect('/role/create');
    }
    public function update(Request $r)
    {
        if(!Right::check('Role', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'name' => $r->name
        );
        DB::table('roles')->where('id', $r->id)->update($data);
        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $r->session()->flash('sms',"ទិន្នន័យត្រូវបានកែប្រែដោយជោគជ័យ។");
            return redirect('/role/edit/'.$r->id);
        }
        $r->session()->flash('sms',"All changes have been saved successfully.");
        return redirect('/role/edit/'.$r->id);
    }
    public function edit($id)
    {
        if(!Right::check('Role', 'u'))
        {
            return view('permissions.no');
        }
        $data['role'] = DB::table('roles')->where('id', $id)->first();
        return view('roles.edit', $data);
    }
    // delete a role by id
    public function delete($id)
    {
        if(!Right::check('Role', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('roles')->where('id', $id)->delete();
        return redirect('/role');
    }
}
