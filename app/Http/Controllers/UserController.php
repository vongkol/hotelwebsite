<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // function to load profile view
    public  function index()
    {
        if(!Right::check('User', 'l')){
            return view('permissions.no');
        }
        $data['users'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->select("users.*", "roles.name as role_name")
            ->get();
        return view("users.index", $data);
    }
    // function to load user profile
    public function load_profile()
    {
        if(!Right::check('User', 'l')){
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')->get();
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('users.profile', $data);
    }
    // load create user form
    public function create()
    {
        if(!Right::check('User', 'i')){
            return view('permissions.no');
        }
        $data['roles'] = DB::table('roles')->get();
        return view('users.create', $data);
    }
    public function edit($id)
    {
        if(!Right::check('User', 'u')){
            return view('permissions.no');
        }
        $data['user'] = DB::table('users')->where('id', $id)->first();
        $data['roles'] = DB::table('roles')->get();
        return view('users.edit', $data);
    }
    // delete a user by his/her id
    public function delete($id)
    {
        if(!Right::check('User', 'd')){
            return view('permissions.no');
        }
        DB::table('users')->where('id', $id)->delete();
        return redirect('/user');
    }
    // function to upload photo
    public function update_profile(Request $r)
    {
      
        $file_name = "";
        $sms = "";
        $sms1 = "";
        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $sms = "ពត៌មានប្រូហ្វាល់ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
            $sms1 = "All changes have been saved successfully.";
        }
        else{
            $sms = "ពត៌មានប្រូហ្វាល់មិនអាចធ្វើការផ្លាស់ប្តូរបានទេ, សូមត្រួតពិនិត្យម្តងទៀត!";
            $sms1 = "Fail to save changes. Please check your entry again!";
        }
        if($r->photo)
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            // update data in table
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role,
                'photo' => $file_name
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
        else{
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
    }
    // save user
    public function save(Request $r)
    {
        if(!Right::check('User', 'i')){
            return view('permissions.no');
        }
        $file_name = "default.png";
        $sms = "";
        $sms1 = "";
        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $sms = "អ្នកប្រើប្រាស់ថ្មី ត្រូវបានបង្កើតដោយជោគជ័យ។";
            $sms1 = "New user has been created successfully.";
        }
        else{
            $sms = "មិនអាចបង្កើតអ្នកប្រើប្រាស់ថ្មីបានទេ, សូមត្រួតពិនិត្យម្តងទៀត!";
            $sms1 = "Fail to create new user. Please check your entry again!";
        }
        if($r->photo)
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'photo' => $file_name,
            'language' => $r->language,
            'role_id' => $r->role
        );
        $i = DB::table('users')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/user/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/create');
        }
    }
    // update user
    public function update(Request $r)
    {
        if(!Right::check('User', 'u')){
            return view('permissions.no');
        }
        $file_name = "";
        $sms = "";
        $sms1 = "";
        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $sms = "ពត៌មានអ្នកប្រើប្រាស់ ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
            $sms1 = "All changes have been saved successfully.";
        }
        else{
            $sms = "មិនអាចធ្វើការផ្លាស់ពត៌មានបានទេ, សូមត្រួតពិនិត្យម្តងទៀត!";
            $sms1 = "Fail to update user. Please check your entry again!";
        }
        $data = array();
        if($r->photo)
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'photo' => $file_name,
                'language' => $r->language,
                'role_id' => $r->role
            );
        }
        else
        {
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role
            );
        }
        $i = DB::table('users')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/user/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/edit/'.$r->id);
        }
    }
    // load reset password form
    public function reset_password()
    {
        return view('users.reset-password');
    }
    public function change_password(Request $r)
    {
        $id = Auth::user()->id;
        $lang = Auth::user()->language;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;
        if ($new_password!=$confirm_password)
        {
           if ($lang=='kh')
           {
               $r->session()->flash('sms1',"លេខសម្ងាត់ថ្មីមិនត្រឹមត្រូវទេ សូមពិនិត្យឡើងវិញ។");
               return redirect('/user/reset-password')->withInput();
           }
           else{
               $r->session()->flash('sms1',"The password is not matched, please check again.");
               return redirect('/user/reset-password')->withInput();
           }
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            DB::table('users')->where('id', $id)->update($data);
            return redirect('/user/finish');
        }
    }
    public function load_password($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->first();
        return view('users.change-password', $data);
    }
    // update password for other users by admin
    public function update_password(Request $r)
    {
        $id = $r->id;
        $lang = Auth::user()->language;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;
        $sms ="";
        $sms1 = "";
        if ($lang=='kh')
        {
            $sms1 = "លេខសម្ងាត់ថ្មីមិនត្រឹមត្រូវទេ សូមពិនិត្យឡើងវិញ។";
            $sms = "លេខសម្ងាត់ ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
        }
        else{
            $sms = "The password has been changed successfully.";
           $sms1 = "The password is not matched. Please check again!";
        }
        if ($new_password!=$confirm_password)
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/update-password/'.$r->id)->withInput();
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            DB::table('users')->where('id', $id)->update($data);
            $r->session()->flash('sms', $sms);
            return redirect('/user/update-password/'.$r->id)->withInput();
        }
    }
    // load final page of change password success
    public function finish_page()
    {
        return view('users.finish-page');
    }
    // load branch for adding to each user
    public function branch($id)
    {
        $data['user'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->where('users.id', $id)
            ->select("users.*", "roles.name as role_name")
            ->first();
        $data['branches'] = DB::table('branches')->get();
        // get all branches for the current user
        $data['user_branches'] = DB::table('user_branches')
            ->join('users', "user_branches.user_id","=","users.id")
            ->join('branches', "user_branches.branch_id", "=", "branches.id")
            ->where("user_branches.user_id",$id)
            ->select("user_branches.*", "branches.name")
            ->get();
        return view("users.branches", $data);
    }
    public function add_branch(Request $r)
    {
        $data = array(
            'user_id' => $r->user_id,
            'branch_id' => $r->branch_id
        );
        $i = DB::table('user_branches')->insertGetId($data);
        return $i;
    }
    public function delete_branch($id)
    {

        $i = DB::table('user_branches')->where('id', $id)->delete();
        return $i;
    }
}
