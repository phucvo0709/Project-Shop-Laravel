@extends('layout')
@section('content')
	<div class="container">
		<section id="cart_items">
				<div class="breadcrumbs">
					<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Shopping Cart</li>
					</ol>
				</div>
				<?php 
					$contents = Cart::getContent(); 
				?>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Image</td>
								<td class="item">Item</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($contents as $v_content)
								<tr>
									<td class="cart_product">
									<a href=""><img src="{{URL::to($v_content->attributes->image)}}"
										style="height: 80px; width: 80px" alt="{{$v_content->name}}"></a>
									</td>
									<td class="cart_description">
										<h4><a href="">{{$v_content->name}}</a></h4>
									</td>
									<td class="cart_price">
										<p>$ {{$v_content->price}}</p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<form action="{{URL::to('/update-cart')}}" method="post">
												@csrf	
												<input type="hidden" name="id" value="{{$v_content->id}}">
												<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2">
												<input type="submit" name="submit" class="btn btn-sm btn-default" value="update">
											</form>
										</div>
									</td>
									<td class="cart_total">
									<p class="cart_total_price">$ {{$v_content->price * $v_content->quantity}}</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->id)}}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="col-sm-8" style="padding: 10px;">
						<div class="total_area">
							<ul>
								<li>Cart Sub Total <span>{{Cart::getTotalQuantity()}} item</span></li>
								<li>Cart Total <span>$ {{Cart::getTotal()}}</span></li>	
							</ul>
							<a href="{{URL::to('/login-checkout')}}" class="btn btn-default check_out">Check Out</a>
						</div>
					</div>
				</div>
		</section> <!--/#cart_items-->
	</div>
@endsection