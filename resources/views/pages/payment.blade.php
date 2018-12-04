@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
                     $contents=Cart::getContent();

				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contents as $v_content) {?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to($v_content->attributes->image)}}" height="80px" width="80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}}</p>
							</td>
							<td class="cart_quantity">
							<div class="cart_quantity_button">
								<form action="{{url('/update-cart')}}" method="post">
									{{ csrf_field()}}
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->quantity}}" autocomplete="off" size="2">
									<input  type="hidden" name="id" value="{{$v_content->id}}"  >
									<input type="submit" name="submit" value="update" class="btn btn-sm btn-default">
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
                       <?php }?>
					</tbody>
				</table>
            </div>
            <form action="{{URL::to('/order-place')}}" method="post">   
                @csrf
                <input type="submit" class="btn btn-default" style="margin: 10px" value="Done">
            </form>
		</div>
	</section> <!--/#cart_items-->
@endsection