@extends('layouts.frontend-master')

@section('content')

<!-- Breadcrumb Section Begin -->
  <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="/shop">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<section class="checkout-section spad">
    <div class="container">
    <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data" class="checkout-form">
        @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        {{-- <a href="#" class="content-btn">Click Here To Login</a> --}}
                    </div>
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="fir">First Name<span>*</span></label>
                            <input type="text" id="fir" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') ?? Auth::user()->name  }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>   
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="last">Last Name<span>*</span></label>
                            <input type="text" id="last" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') ?? Auth::user()->name  }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>   
                              @enderror
                        </div>
          
                        <div class="col-lg-12">
                            <label for="street">Street Address<span>*</span></label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address')  ?? Auth::user()->address  }}">
                         @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>   
                        @enderror
                        </div>

                        <div class="col-lg-12">
                            <label for="zip">Postcode / ZIP (optional)</label>
                            <input type="text" id="zip" name="zipcode" class="form-control @error('zipcode') is-invalid @enderror" value="{{ old('zipcode') ?? 0  }}">
                         @error('zipcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>   
                        @enderror
                        </div>
                   
                        <div class="col-lg-6">
                            <label for="email">Email Address<span>*</span></label>
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? Auth::user()->email  }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>   
                        @enderror
                        </div>

                        <div class="col-lg-6">
                            <label for="phone">Phone<span>*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? Auth::user()->phone  }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>   
                        @enderror
                        </div>
                
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        {{-- <input type="text" placeholder="Enter Your Coupon Code"> --}}
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                         
                                @foreach ($cartItems as $item)
                                    <li class="fw-normal">{{$item->name}} &nbsp<strong class="text-danger">X</strong>&nbsp {{$item->quantity}} <span>${{ Cart::session(auth()->id())->get($item->id)->getPriceSum()}}</span></li>
                                @endforeach
                                <li class="fw-normal">Subtotal <span>${{ Cart::session(auth()->id())->getSubTotal()}}</span></li>
                                <li class="total-price">Total <span>${{ Cart::session(auth()->id())->getTotal()}}</span></li>
                            </ul>
                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cheque Payment
                                        {{-- <input type="checkbox" id="pc-check"> --}}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                        Paypal
                                        {{-- <input type="checkbox" id="pc-paypal"> --}}
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection