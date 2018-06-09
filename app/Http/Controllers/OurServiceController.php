<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class OurServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $data['our_services'] = DB::table('our_services')
            ->get();
        return view('our-services.index', $data);
    }
   

    public function edit($id)
    {
        $data['os'] = DB::table('our_services')
            ->where('id',$id)->first();
        return view('our-services.edit', $data);
    }

    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'qoute' => $r->qoute,
            'description' => $r->description
        );
        $i = DB::table('our_services')->where('id', $r->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/admin/text-welcome/edit/'.$r->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/text-welcome/edit/'.$r->id);
        }
    }
}

