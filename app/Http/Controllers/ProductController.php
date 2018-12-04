<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        return view('admin.add_product');
    }
    
    public function all_product(){
        $all_product_info = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_manufacture', 'tbl_product.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
            ->get();

        $manager_product = view('admin.all_product')->with('all_product_info', $all_product_info);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_public'] = (empty($request->public))? 0 : 1 ;

        $image = $request->file('product_image');
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['product_image'] = $image_url;
        
                DB::table('tbl_product')->insert($data);
                Session::put('message', 'Product added successfully');
                return Redirect::to('/add-product');
            }
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Product added successfully without image');
        return Redirect::to('/add-product');
    }

    public function active_product($product_id){
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_public'=>1]);
            Session::put('message', 'Active product successfully');
            return Redirect::to('/all-product');
    }

    public function unactive_product($product_id){
        DB::table('tbl_product')
        ->where('product_id', $product_id)
        ->update(['product_public'=>0]);
        
        Session::put('message', 'Unactive product successfully');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id){
        $product_info = DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->first();
        return view('admin.edit_product')->with('product_info', $product_info);
    }

    public function update_product(Request $request, $product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;

        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update($data);

        Session::put('message', 'product update successfully');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id){
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->delete();

        Session::put('message', 'Delete product successfully');
        return Redirect::to('/all-product');
    }
}
