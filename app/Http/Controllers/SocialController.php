<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        if(!Right::check('Social', 'l'))
        {
            return view('permissions.no');
        }
        $data['socials'] = DB::table('socials')
            ->where('active',1)
            ->orderBy('order_number')
            ->paginate(18);
        return view('socials.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Social', 'i'))
        {
            return view('permissions.no');
        }
        return view('socials.create');
    }
    // save new social
    public function save(Request $r)
    {
    	$file_name = '';
        if($r->icon) {
            $file = $r->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/socials/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'icon' => $file_name,
            'order_number' => $r->order_number
        );
        $sms = "The new branch has been created successfully.";
        $sms1 = "Fail to create the new branch, please check again!";
        $i = DB::table('socials')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/social/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/social/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Social', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('socials')->where('id', $id)->update(['active'=>0]);
        return redirect('/social');
    }

    public function edit($id)
    {   
        if(!Right::check('Social', 'u'))
        {
            return view('permissions.no');
        }
        $data['social'] = DB::table('socials')
            ->where('id',$id)->first();
        return view('socials.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'url' => $r->url,
            'order_number' => $r->order_number
        );
        if ($r->icon) {
            $file = $r->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/socials/';
            $file->move($destinationPath, $file_name);
            $data = array(
	            'icon' => $file_name
            );
        } 
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('socials')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/social/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/social/edit/'.$r->id);
        }
    }
}
