  <!-- Header Section Begin -->
  <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        @auth
                        {{Auth::user()->email}}  
                        @endauth
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-user"></i>
                        @can('manage')
                            <a href="{{route('admin.users.index') }}">QT</a>
                        @else
                            Welcome++
                        @endcan                
                    </div>
                </div>
                <div class="ht-right">

                     @if (Route::has('login'))
                      @auth
                            <a class="login-panel" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fa fa-lock"></i> Logout
                            </a>
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                       
                    @endauth
                    @endif   
                  
                    {{-- <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                           
                            @if(Route::has('login'))
                                @auth
                                <option value='yt' data-imagecss="flag yt"
                                data-title="English">
                                    {{Auth::user()->name}}<br>  
                                </option>           
                                @else
                                   <option value="">Let's Login</option>
                                @endauth
                            @endif
                  
                            <option value='yu'  data-imagecss="flag yu"
                                data-title="Bangladesh"> </option>
                        </select>

                    </div> --}}

                    <div class="lan-selector px-4">
                        @if(Route::has('login'))
                            @auth                 
                                  <a href="{{route('Account.account')}}" class="text-dark">{{Auth::user()->name}}</a>   
                        
                            @else
                                 <a class="text-danger" href="{{route('login')}}">Let's Login</a>
                            @endauth
                        @endif
                    </div>

                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{FRONT_ASSET_URL}}/img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <form id="add-form"  class="input-group" action="{{route('Page.search')}}" method="get" enctype="multipart/form-data" >
                                <input type="text" name="query" placeholder="What do you need?" required>
                                <button type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                {{-- <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a> --}}
                            </li>
                            <li class="cart-icon">
                                <a href="/cart">
                                    <i class="icon_bag_alt"></i>
                                    <span>                                 
                                            @auth
                                                {{Cart::session(auth()->id())->getContent()->count()}}
                                            @else
                                                 0
                                            @endauth
                                    </span>
                                </a>
                                {{-- <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="si-pic"><img src="{{FRONT_ASSET_URL}}/img/select-product-1.jpg" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>$60.00 x 1</p>
                                                            <h6>Kabino Bedside Table</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>                                         
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>$120.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div> --}}
                            </li>
                            <li class="cart-price">
                                @auth
                                    $ {{ Cart::session(auth()->id())->getTotal() }}
                                @else
                                    Let's shop
                                @endauth
                                {{-- @if (Session::has('Cart'))
                                   $ {{ Cart::session(auth()->id())->getTotal() }}
                                @else
                                    Let's shop
                                @endif  --}}                            
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                          @isset($categories)
                            @foreach ($categories as $item)
                                    <li><a href="/shop/{{$item->id}}">{{$item->cate_name}}</a></li>
                            @endforeach
                          @endisset                        
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class=""><a href="/">Home</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <!-- <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li> -->
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="/cart">Shopping Cart</a></li>
                                <li><a href="/check-out">Checkout</a></li>
                                <li><a href="/register">Register</a></li>
                                <li><a href="/login">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->