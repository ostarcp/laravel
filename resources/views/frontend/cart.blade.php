@extends('layouts.frontend-master')
@section('title','Shopping cart')
@section('content')

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="/shop">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
@if (session('status'))
        <div class="alert alert-danger text-center">
            {{ session('status') }}
        </div>
@endif

@if (session('msg'))
        <div class="alert alert-success text-center">
            {{ session('msg') }}
        </div>
@endif

 <!-- Shopping Cart Section Begin -->
 <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="cart-pic first-row"><img src="storage/{{$item->model->image}}" width="100px" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$item->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">${{$item->price}}</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                        
                                    <form action="{{ route('cart.update',$item->id) }}">
                                           <div class="pro-qty">
                                                    <input name="quantity" type="number" value="{{$item->quantity }}">                                           
                                            </div>                               
                                        </div>
                                    </td>

                                    <td class="first-row">                                     
                                            <input type="submit" class="primary-btn up-cart" value="save">                                            
                                   </td>
                                    </form>

                                    <td class="total-price first-row">${{ Cart::session(auth()->id())->get($item->id)->getPriceSum()}}</td>
                                   
                                    <td class="close-td first-row">
                                          <a href="{{route('cart.destroy',$item->id)}}"> <i class="ti-close"></i></a> 
                                    </td>
                                    
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="javascript:history.back()" class="primary-btn continue-shop">Go Back</a>
                                <a href="/shop" class="primary-btn continue-shop">Continue shopping</a>
                                {{-- <a href="#" class="primary-btn up-cart">Update cart</a> --}}
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>${{ Cart::session(auth()->id())->getSubTotal()}}</span></li>
                                <li class="cart-total"> Total  <span>${{ Cart::session(auth()->id())->getTotal()}}</span></li>
                                </ul>
                                <a href="{{route('cart.checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection