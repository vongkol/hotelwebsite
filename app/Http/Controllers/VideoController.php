<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Video', 'l'))
        {
            return view('permissions.no');
        }
        $data['videos'] = DB::table('videos')
            ->join('video_categories', 'videos.category_id', 'video_categories.id')
            ->where('videos.active',1)
            ->orderBy('videos.id', 'desc')
            ->select('videos.*', 'video_categories.name')
            ->paginate(18);
        return view('videos.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Video', 'i'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('video_categories')->where('active', 1)->get();
        return view('videos.create', $data);
    }
    // save new social
    public function save(Request $r)
    {
        if(!Right::check('Video', 'i'))
        {
            return view('permissions.no');
        }
        $data = array(
            'url' => $r->url,
            'title' => $r->title,
            'category_id' => $r->category
        );
        $i = DB::table('videos')->insertGetId($data);

        if($r->hasFile('image')) {
            $file = $r->file('image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'video' .$i . $ss;
            $destinationPath = 'uploads/videos/'; // usually in public folder
         
            $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $file->move($destinationPath, $file_name);
            $data['poster_image'] = $file_name;
            $i = DB::table('videos')->where('id', $i)->update($data);
        }
        if ($i) {
            $r->session()->flash("sms", "New video has been created successfully!");
            return redirect("/admin/video/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new video!");
            return redirect("/admin/video/create")->withInput();
        }   
    }
    // delete
    public function delete($id)
    {
        if(!Right::check('Video', 'd'))
        {
            return view('permissions.no');
        }

        DB::table('videos')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/video');
    }

    public function edit($id)
    {
        if(!Right::check('Video', 'u'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('video_categories')->where('active', 1)->get();
        $data['video'] = DB::table('videos')
            ->where('id',$id)->first();
        return view('videos.edit', $data);
    }
    
    public function update(Request $r)
    {
        if(!Right::check('Video', 'u'))
        {
            return view('permissions.no');
        }
    	$data = array(
            'url' => $r->url,
            'title' => $r->title,
            'category_id' => $r->category
        );
        if ($r->image) {
            $file = $r->file('image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'video' .$r->id . $ss;
            $destinationPath = 'uploads/videos/'; // usually in public folder
         
            $new_img = Image::make($file->getRealPath())->resize(180, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $file->move($destinationPath, $file_name);
            $data['poster_image'] = $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('videos')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/video/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/video/edit/'.$r->id);
        }
    }
}
