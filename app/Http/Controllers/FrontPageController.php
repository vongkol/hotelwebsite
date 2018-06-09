<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
class FrontPageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    // index
    public function index($id)
    {
        $data['page'] = DB::table('pages')
            ->where('id', $id)
            ->first();
            return view('fronts.page', $data);
    }
    public function about()
    {
        $data['about'] = DB::table('pages')
            ->where('id', 4)
            ->first();
        return view('fronts.pages.about', $data);
    }
    public function contact()
    {
        $data['contact'] = DB::table('pages')
            ->where('id', 5)
            ->first();
        return view('fronts.pages.contact', $data);
    }
    public function page($id)
    {
        $data['page'] = DB::table('pages')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        return view('fronts.pages.index', $data);
    }
    public function staff() 
    {
        $data['title'] = "KYA Staff";
        $data['staffs'] = DB::table('staffs')
            ->where('section', 'staff')
            ->where('active', 1)
            ->orderBy('order_number')
            ->get();
        return view('fronts.pages.staff', $data);
    }
    
    public function membership() 
    {
        return view('fronts.pages.membership');
    }

    public function membership_save(Request $r) 
    {
        $data = array(
            'english_first_name' => $r->english_first_name,
            'english_family_name' => $r->english_family_name,
            'khmer_first_name' => $r->khmer_first_name,
            'khmer_family_name' => $r->khmer_family_name,
            'date_of_birth' => $r->date_of_birth,
            'place_of_birth' => $r->place_of_birth,
            'current_address' => $r->current_address,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'email' => $r->email,
            'receive_newsletter' => $r->receive_newsletter,
            'social_url' => $r->social_url
        );
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'public/uploads/members';
            $file->move($destinationPath, $file_name);

            $data['photo'] = $file_name;
        }
        $sms = "The new membership has been created successfully.";
        $sms1 = "Fail to create the new membership, please check again!";
        $i = DB::table('memberships')->insert($data);

        if ($i)
        {
             // add to newsletter
             if($r->receive_newsletter=='yes')
             {
                 $d = array(
                     'name' => $r->english_first_name. ' '. $r->english_last_name,
                     'email' => $r->email
                 );
                 $counter = DB::table('newsletters')->where('active',1)->where('email',$r->email)->count();
                 if($counter<=0)
                 {
                     DB::table('newsletters')->insert($d);
                 }
             }
            $r->session()->flash('sms', $sms);
            return redirect('/page/membership-form');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/page/membership-form')->withInput();
        }
    }

    public function staff_detail($id) 
    {
        $data['s'] = DB::table('staffs')
            ->where('id', $id)
            ->where('active', 1)
            ->first();
        return view('fronts.pages.staff-detail', $data);
    }
    public function recent_news_detail($id) 
    {
        $data['news'] = DB::table('posts')
            ->where('id', $id)
            ->where('active', 1)
            ->first();
        return view('fronts.pages.recent-news-detail', $data);
    }
    public function recent_news_all() 
    {
        $data['news'] = DB::table('posts')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(12);
        return view('fronts.pages.recent-news-all', $data);
    }
    public function board() 
    {
        $data['title'] = "BOD Members";
        $data['staffs'] = DB::table('staffs')
            ->where('section', 'board')
            ->where('active', 1)
            ->orderBy('order_number')
            ->get();
        return view('fronts.pages.staff', $data);
    }
    
    // save new newsletter
    public function newsletter_save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
        );
        $sms = "The subscribe newsletter has been created successfully.";
        $sms1 = "Fail to create the new newsletter, please check again!";
        $i = DB::table('newsletters')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/public/newsletter/sms');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/public/newsletter/sms');
        }
    }
    // index
    public function newsletter_sms()
    {
        return view('fronts.pages.sms-newsletter');
    }
}
