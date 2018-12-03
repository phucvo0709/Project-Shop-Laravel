<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }
    
    public function show_dashboard(){
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        
        $result = DB::table('tbl_admin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
        if($result){
            session::put('admin_id', $result->admin_id);
            session::put('admin_email', $result->admin_email);
            session::put('admin_name', $result->admin_name);
            return Redirect::to('/dashboard');
        }else{
            session::put('message', 'Email or Password Invaild');
            return Redirect::to('/admin');
        }
    }

}
