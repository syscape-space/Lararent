<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset( config('settings.admin').'/plugins/images/favicon.png')}}">
    <title>{{ config('settings.admin-name', '') }}</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="{{asset( config('settings.admin').'/bootstrap/dist/css/bootstrap.min.css')}} " rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->

    <link href="{{asset( config('settings.admin').'/css/animate.css')}}" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="{{asset( config('settings.admin').'/css/style.css')}}" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="{{asset( config('settings.admin').'/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
<!-- Preloader -->
{{--<div class="preloader">--}}
{{--<div class="cssload-speeding-wheel"></div>--}}
{{--</div>--}}
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            @yield('content')

        </div>
    </div>
</section>
<!-- jQuery -->

{{ $lr_footer ?? '' }}

<script src="{{asset( config('settings.admin').'/plugins/components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset( config('settings.admin').'/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset( config('settings.admin').'/js/sidebarmenu.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset( config('settings.admin').'/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset( config('settings.admin').'/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset( config('settings.admin').'/js/custom.js')}}"></script>
<!--Style Switcher -->
<script src="{{asset( config('settings.admin').'/plugins/components/styleswitcher/jQuery.style.switcher.js')}}"></script>
</body>

</html>
