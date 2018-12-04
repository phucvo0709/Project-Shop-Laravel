<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $product_info = DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->first();
        
        $data['quantity'] = $quantity;
        $data['id'] = $product_info->product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['attributes']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
    }

    public function show_cart(){
        $all_public_category=DB::table('tbl_category')
            ->where('public', 1)
            ->get();
        $manage_public_category = view('pages.show_cart')->with('all_public_category', $all_public_category);
        return view('layout')->with('pages.show_cart', $manage_public_category);   
    }

    public function delete_to_cart($id){
        Cart::remove($id);
        return view('pages.show_cart');
    }

    public function update_cart(Request $request){
        $quantity = $request->quantity;
        $id = $request->id;
        Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity
            ),
          ));
        return Redirect::to('/show-cart');
    }
    
}
