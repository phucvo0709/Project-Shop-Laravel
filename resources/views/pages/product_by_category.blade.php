@extends('layout')
@section('content')
    
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach ($product_by_category as $v_product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to($v_product->product_image)}}" alt="" />
                                <h2>$ {{$v_product->product_price}}</h2>
                                <a href="{{URL::to('/view-product/'.$v_product->product_id)}}"><p>{{$v_product->product_name}}</p></a>
                            </div>
                    </div>
                </div>
            </div> 
        @endforeach
        
    </div><!--features_items-->
@endsection