<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ManufactureController extends Controller
{
    public function index(){
        return view('admin.add_manufacture');
    }
    
    public function all_manufacture(){
        $all_manufacture_info = DB::table('tbl_manufacture')->get();
        $manager_manufacture = view('admin.all_manufacture')->with('all_manufacture_info', $all_manufacture_info);
        return view('admin_layout')->with('admin.all_manufacture', $manager_manufacture);
    }

    public function save_manufacture(Request $request){
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['public'] = (empty($request->public))? 0 : 1 ;
        
        DB::table('tbl_manufacture')->insert($data);
        Session::put('message', 'manufacture added successfully');
        return Redirect::to('/add-manufacture');
    }

    public function active_manufacture($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update(['public'=>1]);
            Session::put('message', 'Active manufacture successfully');
            return Redirect::to('/all-manufacture');
    }

    public function unactive_manufacture($manufacture_id){
        DB::table('tbl_manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->update(['public'=>0]);
        
        Session::put('message', 'Unactive manufacture successfully');
        return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($manufacture_id){
        $manufacture_info = DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->first();
        return view('admin.edit_manufacture')->with('manufacture_info', $manufacture_info);
    }

    public function update_manufacture(Request $request, $manufacture_id){
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;

        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);

        Session::put('message', 'manufacture update successfully');
        return Redirect::to('/all-manufacture');
    }

    public function delete_manufacture($manufacture_id){
        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->delete();

        Session::put('message', 'Delete manufacture successfully');
        return Redirect::to('/all-manufacture');
    }

}
