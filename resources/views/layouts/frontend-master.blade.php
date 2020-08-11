<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ostar | @yield('title','Master')</title>

    @include('layouts._front-share.style')
   
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    @include('layouts._front-share.header')

    <!-- Hero Section Begin -->
   
    
   
    <!-- Hero Section End -->

    <div class="main-contents">
            @yield('content')
    </div>
 
    <!-- Partner Logo Section End -->
    @include('layouts._front-share.footer')

    @include('layouts._front-share.script')

    @yield('script')
</body>

</html>