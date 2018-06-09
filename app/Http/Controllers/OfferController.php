<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class OfferController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        $data['offers'] = DB::table('offers')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('offers.index', $data);
    }
    public function create()
    {
        return view('offers.create');
    }
    public function save(Request $r)
    {
        if(!Right::check('Portfolio', 'i'))
        {
            return view('permissions.no');
        }	
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
            'order' => $r->order,
        );
        $i = DB::table('offers')->insertGetId($data);
        if($r->hasFile('featured_image')) {
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'offer' .$i . $ss;
            $destinationPath = 'uploads/offers/'; // usually in public folder

            $file->move($destinationPath, $file_name);
            $data['featured_image'] = $file_name;
            $i = DB::table('offers')->where('id', $i)->update($data);
        }
        if ($i) {
            $r->session()->flash("sms", "New offer has been created successfully!");
            return redirect("/admin/offer/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new offer!");
            return redirect("/admin/offer/create")->withInput();
        }   
    }
    // delete
    public function delete($id)
    {
        DB::table('offers')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/offer?page='.$page);
        }
        return redirect('/admin/offer');
    }
    public function edit($id)
    {
        $data['offer'] = DB::table('offers')
            ->where('id',$id)->first();
        return view('offers.edit', $data);
    }
    
    public function update(Request $r)
    {
        if(!Right::check('Portfolio', 'u'))
        {
            return view('permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'order' => $r->order,
            'description' => $r->description
        );
        if ($r->featured_image) {
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'offer' .$r->id . $ss;
            $destinationPath = 'uploads/offers/'; // usually in public folder
         
            $file->move($destinationPath, $file_name);
            $data['featured_image'] = $file_name;        
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('offers')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/offer/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/offer/edit/'.$r->id);
        }
    }
}

