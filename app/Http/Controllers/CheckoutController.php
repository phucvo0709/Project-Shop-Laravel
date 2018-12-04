<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function index(){
        return view('pages.checkout');
    }

    public function login_checkout(){
        return view('pages.login');
    }

    public function customer_login(Request $request){
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = DB::table('tbl_customer')
            ->where('customer_email', $customer_email)
            ->where('customer_password', $customer_password)
            ->first();
            
        if($result){
            Session::put('customer_id', $result->customer_id);  
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }

    public function customer_register(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        
        return Redirect::to('/checkout');
    }

    public function save_shipping_details(Request $request){
        $data = array();
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);  
        Session::put('shipping_id', $shipping_id); 
        return Redirect::to('payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function payment(){
        return view('pages.payment');
    }
}
