<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{

    public function index(){
        return view('admin.add_slider');
    }
    
    public function all_slider(){
        $all_slider_info = DB::table('tbl_slider')->get();
        $manager_slider = view('admin.all_slider')->with('all_slider_info', $all_slider_info);
        return view('admin_layout')->with('admin.all_slider', $manager_slider);
    }

    public function save_slider(Request $request){
        $data = array();
        $data['slider_name'] = $request->slider_name;
        $data['public'] = (empty($request->public))? 0 : 1 ;

        $image = $request->file('slider_image');
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'slider/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success){
                $data['slider_image'] = $image_url;
        
                DB::table('tbl_slider')->insert($data);
                Session::put('message', 'slider added successfully');
                return Redirect::to('/add-slider');
            }
        }

        $data['slider_image'] = '';
        DB::table('tbl_slider')->insert($data);
        Session::put('message', 'slider added successfully');
        return Redirect::to('/add-slider');
    }

    public function active_slider($slider_id){
        DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update(['public'=>1]);
            Session::put('message', 'Active slider successfully');
            return Redirect::to('/all-slider');
    }

    public function unactive_slider($slider_id){
        DB::table('tbl_slider')
        ->where('slider_id', $slider_id)
        ->update(['public'=>0]);
        
        Session::put('message', 'Unactive slider successfully');
        return Redirect::to('/all-slider');
    }

    public function edit_slider($slider_id){
        $slider_info = DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->first();
        return view('admin.edit_slider')->with('slider_info', $slider_info);
    }

    public function update_slider(Request $request, $slider_id){
        $data = array();
        $data['slider_name'] = $request->slider_name;
        $data['slider_description'] = $request->slider_description;

        DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->update($data);

        Session::put('message', 'slider update successfully');
        return Redirect::to('/all-slider');
    }

    public function delete_slider($slider_id){
        DB::table('tbl_slider')
            ->where('slider_id', $slider_id)
            ->delete();

        Session::put('message', 'Delete slider successfully');
        return Redirect::to('/all-slider');
    }

}
