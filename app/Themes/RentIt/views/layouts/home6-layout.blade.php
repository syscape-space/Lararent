<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?? ''}}</title>


    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset(config('settings.theme')) }}/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="{{ asset(config('settings.theme')) }}/assets/ico/favicon.ico">
    {!! $lr_header ?? '' !!}

</head>
<body id="home" class="wide full-screen-map">
@if(get_theme_mod('rentit_enable_preloader',1))
    <!-- PRELOADER -->
    <div id="preloader">
        <div id="preloader-status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
            <div id="preloader-title">{{__('Loading')}}</div>
        </div>
    </div>
    <!-- /PRELOADER -->
@endif
<!-- /PRELOADER -->

<!-- Google map -->
<div class="google-map">
    <div class="map-canvas" id="map-canvas"></div>
</div>
<!-- /Google map -->

<!-- WRAPPER -->
<div class="wrapper opened">

    <!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">

                <!-- Logo -->
                <!-- Logo --><?php

	            if(get_theme_mod( 'header_logo' )){ ?>
                <div class="logo">

                    <a href="{{ url('/') }}"><img
                                src="<?php  echo the_image_url( get_theme_mod( 'header_logo' ) ); ?>"
                                alt="Rent It"/></a>

                </div> <?php  } ?>
                <!-- /Logo -->

                <!-- Mobile menu toggle button -->
                <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>
                <!-- /Mobile menu toggle button -->

                <ul class="sign-in-menu">
                    <li class="sign-in"><a href="#"><i class="fa fa-user"></i><span class="text">Sign In</span></a></li>
                    <li class="register active"><a href="#"><i class="fa fa-sign-in"></i><span class="text">Register</span></a></li>
                </ul>

                <!-- Navigation -->
                <nav class="navigation closed clearfix">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <!-- navigation menu -->
                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                        <?php
                        echo cache()->rememberForever( 'header-menu', function () {
	                        return app( 'BaseCms' )->nav_menu( [
		                        'theme_location' => 'header-menu',
		                        'echo' => false
	                        ] );
                        } );
                        ?>
                            <!-- /navigation menu -->
                        </div>
                    </div>
                    <!-- Add Scroll Bar -->
                    <div class="swiper-scrollbar"></div>
                </nav>
                <!-- /Navigation -->

            </div>
        </div>

    </header>
    <!-- /HEADER -->
{!! $content ?? '' !!}
    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>

{!!   $lr_footer ?? '' !!}
</body>
</html>