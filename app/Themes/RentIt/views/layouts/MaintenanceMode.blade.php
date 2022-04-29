<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title ?? ''}}</title>
    <title>{{$title ?? ''}}</title>


    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset(config('settings.theme')) }}/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="{{ asset(config('settings.theme')) }}/assets/ico/favicon.ico">
    {!! $lr_header ?? '' !!}


</head>
<body id="home" class="wide coming-soon">

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
<!-- WRAPPER -->
<div class="wrapper">

    <!-- HEADER -->
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">


                <!-- Logo -->

                @if(get_theme_mod( 'header_logo' ))
                    <div class="logo">

                        <a href="{{ url('/') }}"><img
                                    src="<?php  echo the_image_url( get_theme_mod( 'header_logo' ) ); ?>"
                                    alt="Rent It"/></a>

                    </div>
            @endif
            <!-- /Logo -->


            </div>
        </div>

    </header>
    <!-- /HEADER -->

    <!-- CONTENT AREA -->
    <div class="content-area">

        <!-- PAGE -->
        <section class="page-section no-padding slider">
            <div class="container full-width">

                <div class="main-slider">
                    <div class="owl-carousel-off" id="main-slider-off">

                        <!-- Slide 3 -->
                        <div class="item page slide3- dark-">
                            <div class="caption">
                                <div class="container">
                                    <div class="div-table">
                                        <div class="div-cell">
                                            <div class="caption-content">
                                                <h2 class="caption-title">{{  get_theme_mod('rentit_coming_soon_mode_title',__('Coming soon')) }}</h2>
                                                <!--<h3 class="caption-subtitle"><span>Sub Title</span></h3>-->

                                                <div class="countdown-wrapper">
                                                    <div id="dealCountdown20" class="defaultCountdown clearfix"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Slide 3 -->

                    </div>
                </div>

            </div>
        </section>
        <!-- /PAGE -->

    </div>
    <!-- /CONTENT AREA -->

    <!-- FOOTER -->
    <!-- /FOOTER -->

</div>
{!!   $lr_footer ?? '' !!}

<script type="text/javascript">
    jQuery(document).ready(function () {
        if ($().countdown) {
            var austDay = new Date();

            austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
            var d = new Date();
            //      d.setTime(Date.parse("12/30/2018"));

            d.setTime(Date.parse("{{get_theme_mod('rentit_coming_soon_mode_date')}}"));

            console.log(d);
            if (d !== NaN && d != 'Invalid Date') {
                console.log(d);
                $('#dealCountdown20').countdown({until: d});
            } else {

                $('#dealCountdown20').countdown({until: austDay})
            }
        }
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
    jQuery(window).load(function () {
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
    jQuery(window).resize(function () {
        jQuery('.page').css('height', jQuery(window).height());
        jQuery('.page').css('min-height', jQuery(window).height());
    });
</script>

</body>
</html>