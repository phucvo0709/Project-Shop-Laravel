<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $all_public_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_manufacture', 'tbl_product.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
            ->select('tbl_product.*', 'tbl_category.category_name', 'tbl_manufacture.manufacture_name')
            ->where('tbl_product.product_public', 1)
            ->limit(3)
            ->get();

        $manage_public_product = view('pages.home_content')->with('all_public_product', $all_public_product);
        return view('layout')->with('pages.home_content', $manage_public_product);
    }

    public function show_product_by_category($category_id){
        $product_by_category = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
        ->select('tbl_product.*', 'tbl_category.category_name')
        ->where('tbl_product.category_id', $category_id)
        ->where('tbl_product.product_public', 1)
        ->get();

        $manage_product_by_category = view('pages.product_by_category')->with('product_by_category', $product_by_category);
        return view('layout')->with('pages.product_by_category', $manage_product_by_category);
    }

    public function show_product_by_manufacture($manufacture_id){
        $product_by_manufacture = DB::table('tbl_product')
        ->join('tbl_manufacture', 'tbl_product.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
        ->select('tbl_product.*', 'tbl_manufacture.manufacture_name')
        ->where('tbl_product.manufacture_id', $manufacture_id)
        ->where('tbl_product.product_public', 1)
        ->get();

        $manage_product_by_manufacture = view('pages.product_by_manufacture')->with('product_by_manufacture', $product_by_manufacture);
        return view('layout')->with('pages.product_by_caproduct_by_manufacturetegory', $manage_product_by_manufacture);
    }

    public function product_details_by_id($product_id){
        $product_by_details = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_manufacture', 'tbl_product.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
        ->select('tbl_product.*', 'tbl_category.category_name', 'tbl_manufacture.manufacture_name')
        ->where('tbl_product.product_id', $product_id)
        ->first();

        $manage_product_by_details = view('pages.product_details')->with('product_by_details', $product_by_details);
        return view('layout')->with('pages.product_details', $manage_product_by_details);
    }
}
