<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     // index
     public function index()
     {
        $data['rooms'] = DB::table('rooms')
             ->where('active',1)
             ->orderBy('id', 'desc')
             ->paginate(18);
        return view('rooms.index', $data);
     }
     // load create form
     public function create()
     {
         return view('rooms.create');
     }
     // save new page
     public function save(Request $r)
     {
         $data = array(
             'name' => $r->name,
             'short_description' => $r->short_description,
             'description' => $r->description,
             'price' => $r->price,
             'order' => $r->order,
         );
         $i = DB::table('rooms')->insertGetId($data);
         if($i)
         {
             if($r->feature_image) {
 
                 $file = $r->file('feature_image');
                 $file_name = $file->getClientOriginalName();
                 $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                 $file_name = 'room' .$i . $ss;
                 
                 // upload 250
                 $destinationPath = 'uploads/rooms/';
                 $new_img = Image::make($file->getRealPath())->resize(750, 470);
                 $new_img->save($destinationPath . $file_name, 80);

                 $destinationPath = 'uploads/rooms/small/';
                 $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                     $con->aspectRatio();
                 });
                 $new_img->save($destinationPath . $file_name, 80);
                 DB::table('rooms')->where('id', $i)->update(['featured_image'=>$file_name]);
             }
             $r->session()->flash('sms', 'New room has been created successfully!');
             return redirect('/admin/room/create');
         }
         else{
             $r->session()->flash('sms1', 'Fail to create new room. Please check your input again!');
             return redirect('/admin/room/create')->withInput();
         }
     }
     // delete
     public function delete($id)
     {
         DB::table('rooms')->where('id', $id)->update(['active'=>0]);
         return redirect('/admin/room');
     }
 
     public function edit($id)
     {
         $data['room'] = DB::table('rooms')
             ->where('id',$id)->first();
         return view('rooms.edit', $data);
     }
 
     public function update(Request $r)
     {
         $data = array(
             'name' => $r->name,
             'short_description' => $r->short_description,
             'description' => $r->description,
             'price' => $r->price,
             'order' => $r->order,
         );
         if($r->feature_image) {
            
             $file = $r->file('feature_image');
             $file_name = $file->getClientOriginalName();
             $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
             $file_name = 'room' .$r->id . $ss;
            // upload 250
                 $destinationPath = 'uploads/rooms/';
                 $new_img = Image::make($file->getRealPath())->resize(750, 470);
                 $new_img->save($destinationPath . $file_name, 80);
                 
                 $destinationPath = 'uploads/rooms/small/';
                 $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                     $con->aspectRatio();
                 });
                 $new_img->save($destinationPath . $file_name, 80);
                 $data['featured_image'] =  $file_name;
         }
         $i = DB::table('rooms')->where('id', $r->id)->update($data);
         if ($i)
         {
             $sms = "All changes have been saved successfully.";
             $r->session()->flash('sms', $sms);
             return redirect('/admin/room/edit/'.$r->id);
         }
         else
         {   
             $sms1 = "Fail to to save changes, please check again!";
             $r->session()->flash('sms1', $sms1);
             return redirect('/admin/room/edit/'.$r->id);
         }
     }
     // view detail
     public function view($id) 
     {

         $data['room'] = DB::table('rooms')
             ->where('id',$id)->first();
         return view('rooms.detail', $data);
     }
}
