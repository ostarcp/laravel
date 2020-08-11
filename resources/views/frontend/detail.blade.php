@extends('layouts.frontend-master')
@section('title','Details')
@section('content')
<style>
/* .comment-option {
  padding: 30px;
  height: 430px;
  overflow: auto;
} */
</style>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="/shop">Shop</a>
                     <span>{{$productDetail->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="filter-widget">
                        <h4 class="fw-title">Categories</h4>
                        <ul class="filter-catagories">
                            <li><a href="/shop">All</a></li>
                            @foreach ($categories as $item)
                             <li><a href="/shop/{{$item->id}}">{{$item->cate_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                 
                    <div class="filter-widget">
                        <h4 class="fw-title">Price</h4>
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="33" data-max="98">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <a href="#" class="filter-btn">Filter</a>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Color</h4>
                        <div class="fw-color-choose">
                            <div class="cs-item">
                                <input type="radio" id="cs-black">
                                <label class="cs-black" for="cs-black">Black</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-violet">
                                <label class="cs-violet" for="cs-violet">Violet</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-blue">
                                <label class="cs-blue" for="cs-blue">Blue</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-yellow">
                                <label class="cs-yellow" for="cs-yellow">Yellow</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-red">
                                <label class="cs-red" for="cs-red">Red</label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" id="cs-green">
                                <label class="cs-green" for="cs-green">Green</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Size</h4>
                        <div class="fw-size-choose">
                            <div class="sc-item">
                                <input type="radio" id="s-size">
                                <label for="s-size">s</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="m-size">
                                <label for="m-size">m</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="l-size">
                                <label for="l-size">l</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" id="xs-size">
                                <label for="xs-size">xs</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{$productDetail->imageD()}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <div class="pt active" data-imgbigurl="{{$productDetail->imageD()}}"><img
                                            src="{{$productDetail->imageD() }}" alt=""></div>
                                            @foreach ($productDetail->images as $item)
                                                <div class="pt" data-imgbigurl="/storage/{{$item->small_image}}">
                                                    <img src="/storage/{{$item->small_image}}" alt="">
                                                </div>
                                            @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    {{-- <span>oranges</span> --}}
                                    <h3>{{$productDetail->name}}</h3>
                                    <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p>
                                        {{$productDetail->short_description}}
                                    </p>
                                    <h4>${{$productDetail->price}} </h4>
                                </div>
                                <div class="pd-color">
                                    <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        <div class="cc-item">
                                            <input type="radio" id="cc-black">
                                            <label for="cc-black"></label>
                                        </div>
                                        <div class="cc-item">
                                            <input type="radio" id="cc-yellow">
                                            <label for="cc-yellow" class="cc-yellow"></label>
                                        </div>
                                        <div class="cc-item">
                                            <input type="radio" id="cc-violet">
                                            <label for="cc-violet" class="cc-violet"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-size-choose">
                                    <div class="sc-item">
                                        <input type="radio" id="sm-size">
                                        <label for="sm-size">s</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="md-size">
                                        <label for="md-size">m</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="lg-size">
                                        <label for="lg-size">l</label>
                                    </div>
                                    <div class="sc-item">
                                        <input type="radio" id="xl-size">
                                        <label for="xl-size">xs</label>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" disabled>
                                    </div>
                                    <a href="/add-to-cart/{{$productDetail->id}}" class="primary-btn pd-cart">Add To Cart</a>
                                </div>
                                <ul class="pd-tags">
                                     <li><span>CATEGORIES:</span> {{$productDetail->getCate()->cate_name}}</li>                               
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Mpd : {{$productDetail->id}}</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews ({{$productDetail->comments->count()}})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">

                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5>Description</h5>
                                                {!! $productDetail->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <h3>Comming soon!</h3>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>Comments</h4>
                                        <hr>
                                        <div class="comment-option">  

                                        @foreach ($productDetail->comments as $item)
                                        <div class="co-item row">
                                            <div class="col-10">
                                                <div class="avatar-pic">
                                                    <img src="{{$item->user->avatarImg()}}" alt="">
                                                </div>
                                                <div class="avatar-text">                                                  
                                                    <h5>{{$item->user->name}} <span>{{ date("d/m/Y", strtotime($item->created_at)) }} </span></h5>
                                                    <div class="at-reply">{{$item->content}}</div>                                                                                              
                                                </div>
                                            </div>  

                                            @can('delete-comment',$item)
                                                <div class="col-2 d-flex align-items-center">
                                                    <span class="badge badge-danger"><a class="text-white" href="{{route('Product.deleteCMT',$item)}}">Delete</a></span>
                                                </div>  
                                            @endcan                                                                                      
                                        </div>
                                        @endforeach          
                                 </div>

                                        <hr>
                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                        <form id="comment-form" action="{{route('Account.comment',$productDetail) }}" method="post" class="comment-form">
                                                @csrf
                                            <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" placeholder="Name" name="name">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea name="content_cmt" id="comment-content" placeholder="Messages"></textarea>
                                                        <button type="submit" class="site-btn">Send message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
{{-- <div id="review"></div>
<div id="comments"></div> --}}
    <!-- Related Products Section End -->
    <div class="related-products spad border mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($relativePD as $item)

                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{$item->imageD()}}" alt="" style="width: 100%; height: 300px;">
                            {{-- <div class="sale">Sale</div> --}}
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$item->getCate()->cate_name}}</div>
                            <a href="#">
                            <h5>{{$item->name}}</h5>
                            </a>
                            <div class="product-price">
                                {{$item->price}}
                                {{-- <span>$35.00</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
                    
                @endforeach
       

            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
@endsection

@section('script')
<script>

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    console.log(activeTab);
    if(activeTab){
        $('.tab-item a[href="' + activeTab + '"]').tab('show');
    }
});

// $(document).ready(function() { 
//     setInterval(function(){
//         $("#comments").load('{{ route('Account.loadcomment') }}');                     
//     }, 3000);
// });


// $('#comment-form').submit(function (e) {
// e.preventDefault();

// $.ajax({
//     type: 'POST',
//     cache: false,
//     url: "{{ route('Account.comment',$productDetail) }}",
//     data: {
//         "_token": '{{ csrf_token() }}',
//         "content": $('#comment-content').val(),
//     },
//     success: function (data) {
//         $('#review').html(data);
//         console.log('Submission was successful.');
//     },
//         error: function (data) {
//     console.log('An error occurred.');
//     console.log(data);
//     },
// });
// });
</script>
@endsection