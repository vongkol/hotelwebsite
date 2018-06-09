<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class GalleryController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        $data['gallerys'] = DB::table('gallerys')
            ->join('categories', 'gallerys.category_id', 'categories.id')
            ->where('gallerys.active',1)
            ->orderBy('gallerys.id', 'desc')
            ->select('gallerys.*', 'categories.name as cname')
            ->paginate(18);
        return view('gallerys.index', $data);
    }
    public function create()
    {
        $data['categories'] = DB::table('categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('gallerys.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'category_id' => $r->category,
            'order' => $r->order,
        );
        $i = DB::table('gallerys')->insertGetId($data);
        if($r->hasFile('featured_image')) {
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'featured_image' .$i . $ss;
            $destinationPath = 'uploads/gallerys/'; // usually in public folder
         
            // upload 250
            $n_destinationPath = 'uploads/gallerys/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($n_destinationPath . $file_name, 80);

            $file->move($destinationPath, $file_name);
            $data['featured_image'] = $file_name;
            $i = DB::table('gallerys')->where('id', $i)->update($data);
        }
        if ($i) {
            $r->session()->flash("sms", "New gallery has been created successfully!");
            return redirect("/admin/gallery/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new gallery!");
            return redirect("/admin/gallery/create")->withInput();
        }   
    }
    // delete
    public function delete($id)
    {
        DB::table('gallerys')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/gallery?page='.$page);
        }
        return redirect('/admin/gallery');
    }
    public function edit($id)
    {
        if(!Right::check('Portfolio', 'u'))
        {
            return view('permissions.no');
        }
        $data['gallery'] = DB::table('gallerys')
            ->where('id',$id)->first();
        $data['categories'] = DB::table('categories')
            ->where('active', 1)
            ->get();
        return view('gallerys.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'order' => $r->order,
            'category_id' => $r->category
        );
        if ($r->featured_image) {
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'featured_image' .$r->id . $ss;
            $destinationPath = 'uploads/gallerys/'; // usually in public folder
         
            // upload 250
            $n_destinationPath = 'uploads/gallerys/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($n_destinationPath . $file_name, 80);

            $file->move($destinationPath, $file_name);
            $data['featured_image'] = $file_name;        
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('gallerys')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/gallery/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/gallery/edit/'.$r->id);
        }
    }
}

