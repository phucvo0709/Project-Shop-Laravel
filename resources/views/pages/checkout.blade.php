@extends('layout')
@section('content')
    <div class="col-sm-11 padding-right">
	    <section id="cart_items">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                      <li><a href="#">Home</a></li>
                      <li class="active">Check out</li>
                    </ol>
                </div><!--/breadcrums-->
    
                <div class="shopper-informations">
                    <div class="row">
                        <div class="col-sm-12 clearfix">
                            <div class="bill-to">
                                <p>Bill To</p>
                                <div class="form-one">
                                    <form method="post" action="{{URL::to('/save-shipping-details')}}">
                                        @csrf
                                        <input type="text" placeholder="Email*" name="shipping_email">
                                        <input type="text" placeholder="Name" name="shipping_name">
                                        <input type="text" placeholder="Address" name="shipping_address">
                                        <input type="text" placeholder="Phone" name="shipping_phone">
                                        <input type="submit" class="btn btn-warning" value="Update">
                                    </form>
                                </div>
                            </div>
                        </div>				
                    </div>
                </div>
        </section> <!--/#cart_items-->
    </div>
@endsection