<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>UNICEF - Dashboard</title>
    @yield('header')
   
</head>
<body class="leftbar-view">
<!--Topbar Start Here-->
<header class="topbar clearfix">
    <!--Top Search Bar Start Here-->
    <div class="top-search-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="search-input-addon">
                        <span class="addon-icon"><i class="zmdi zmdi-search"></i></span>
                        <input type="text" class="form-control top-search-input" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Top Search Bar End Here-->
    <!--Topbar Left Branding With Logo Start-->
    <div class="topbar-left pull-left">
        <div class="clearfix">
            <ul class="left-branding pull-left clickablemenu ttmenu dark-style menu-color-gradient">
                <li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
                <li>
                    <div class="logo">
                        <a title="Admin Template"><p style="font-size: 38px; color: #e97005;">UNICEF</p></a>
                    </div>
                </li>
            </ul>
            <!--Mobile Search and Rightbar Toggle-->
            <ul class="branding-right pull-right">
                <li><a href="#" class="btn-mobile-search btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
                <li><a href="#" class="btn-mobile-bar"><i class="zmdi zmdi-menu"></i></a></li>
            </ul>
        </div>
    </div>
    <!--Topbar Left Branding With Logo End-->
    <!--Topbar Right Start-->
    <div class="topbar-right pull-right">
        <div class="clearfix">
            <!--Mobile View Leftbar Toggle-->
           <!-- <ul class="left-bar-switch pull-left">
                <li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
            </ul>
            <ul class="pull-right top-right-icons">
                <li><a href="#" class="btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
            </ul> -->
        </div>
    </div>
    <!--Topbar Right End-->
</header>


@include('layouts.sidemenu')

<!--Leftbar End Here-->
<!--Page Container Start Here-->
<section class="main-container">
<div class="container-fluid">
@yield('content')
</div>
<!--Footer Start Here -->
<footer class="footer-container" style="position: relative; bottom: 0;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="footer-left">
                    <span>© 2016 <a href="http://raipurplus.com/" style="text-decoration: none; color: #e97005;"><b>Raipur Plus</b></a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Footer End Here -->
</section>
<!--Page Container End Here-->
@yield('script')
</body>
</html>