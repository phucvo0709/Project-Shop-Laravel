<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.add_category');
    }
    
    public function all_category(){
        $all_category_info = DB::table('tbl_category')->get();
        return view('admin.all_category')->with('all_category_info', $all_category_info);
    }

    public function save_category(Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['public'] = (empty($request->public))? 0 : 1 ;
        
        DB::table('tbl_category')->insert($data);
        Session::put('message', 'Category added successfully');
        return Redirect::to('/add-category');
    }

    public function active_category($category_id){
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['public'=>1]);
            Session::put('message', 'Active category successfully');
            return Redirect::to('/all-category');
    }

    public function unactive_category($category_id){
        DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->update(['public'=>0]);
        
        Session::put('message', 'Unactive category successfully');
        return Redirect::to('/all-category');
    }

    public function edit_category($category_id){
        $category_info = DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->first();
        return view('admin.edit_category')->with('category_info', $category_info);
    }

    public function update_category(Request $request, $category_id){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update($data);

        Session::put('message', 'Category update successfully');
        return Redirect::to('/all-category');
    }

    public function delete_category($category_id){
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->delete();

        Session::put('message', 'Delete category successfully');
        return Redirect::to('/all-category');
    }

}
