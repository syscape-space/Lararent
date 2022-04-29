<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16"
          href="{{ asset(config('settings.admin')) }}/plugins/images/favicon.png">
    <title>{{ $title ?? '' }}</title>

    {!! $lr_header ?? '' !!}

</head>

<body class="mini-sidebar">
<!-- ===== Main-Wrapper ===== -->
<div id="wrapper">
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- ===== Top-Navigation ===== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">


            <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
               data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </a>
            <div class="top-left-part" style="height: 60px" >
       {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/logo-text.png" alt="homepage"--}}
                    {{--class="dark-logo"/>--}}
                    <a  style="padding: 15px 10px 10px 30px" class="logo waves-effect " href="{{ env('APP_URL') }}" aria-expanded="false">
                        <span class="hide-menu">{{__('admin.Visit Site')}}</span></a>

            </div>


            <ul class="nav navbar-top-links navbar-left hidden-xs">

                <li>
                    <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i
                                class="icon-arrow-left-circle"></i></a>
                </li>
                {{--<li>--}}
                    {{--<form role="search" class="app-search hidden-xs">--}}
                        {{--<i class="icon-magnifier"></i>--}}
                        {{--<input type="text" placeholder="Search..." class="form-control">--}}
                    {{--</form>--}}
                {{--</li>--}}

            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">

                <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                        <i class="icon-speech"></i>
                        <span class="badge badge-xs badge-danger admin-notices-bagde"></span>
                    </a>
                    <ul class="admin-notices dropdown-menu mailbox animated bounceInDown">
                        @action('dashboard.icon-header')
                    </ul>
                </li>
                <li>
                    <div class="pull-right">
                        <div class="language-switcher">
                            <button type="button"
                                    class="btn waves-effect waves-light btn-info dropdown-toggle"
                                    data-toggle="dropdown">{{__('admin.Language')}} {{App::getLocale()}} <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu">


                                @foreach(config('translatable.locales') as $v)
                                    <li @if(App::getLocale() == $v) class="active" @endif>
                                        <a href="{{ route( 'setlocale', [ 'lang' => $v] )}}"><span
                                                    class="flag-icon flag-icon-ru"></span> {{$v}} </a>
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>
                </li>
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown"--}}
                       {{--href="javascript:void(0);">--}}
                        {{--<i class="icon-speech"></i>--}}
                        {{--<span class="badge badge-xs badge-danger">6</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu mailbox animated bounceInDown">--}}
                        {{--<li>--}}
                            {{--<div class="drop-title">You have 4 new messages</div>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<div class="message-center">--}}
                                {{--<a href="javascript:void(0);">--}}
                                    {{--<div class="user-img">--}}
                                        {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/users/1.jpg"--}}
                                             {{--alt="user" class="img-circle">--}}
                                        {{--<span class="profile-status online pull-right"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="mail-contnet">--}}
                                        {{--<h5>Pavan kumar</h5>--}}
                                        {{--<span class="mail-desc">Just see the my admin!</span>--}}
                                        {{--<span class="time">9:30 AM</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<a href="javascript:void(0);">--}}
                                    {{--<div class="user-img">--}}
                                        {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/users/2.jpg"--}}
                                             {{--alt="user" class="img-circle">--}}
                                        {{--<span class="profile-status busy pull-right"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="mail-contnet">--}}
                                        {{--<h5>Sonu Nigam</h5>--}}
                                        {{--<span class="mail-desc">I've sung a song! See you at</span>--}}
                                        {{--<span class="time">9:10 AM</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<a href="javascript:void(0);">--}}
                                    {{--<div class="user-img">--}}
                                        {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/users/3.jpg"--}}
                                             {{--alt="user" class="img-circle"><span--}}
                                                {{--class="profile-status away pull-right"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="mail-contnet">--}}
                                        {{--<h5>Arijit Sinh</h5>--}}
                                        {{--<span class="mail-desc">I am a singer!</span>--}}
                                        {{--<span class="time">9:08 AM</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<a href="javascript:void(0);">--}}
                                    {{--<div class="user-img">--}}
                                        {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/users/4.jpg"--}}
                                             {{--alt="user" class="img-circle">--}}
                                        {{--<span class="profile-status offline pull-right"></span>--}}
                                    {{--</div>--}}
                                    {{--<div class="mail-contnet">--}}
                                        {{--<h5>Pavan kumar</h5>--}}
                                        {{--<span class="mail-desc">Just see the my admin!</span>--}}
                                        {{--<span class="time">9:02 AM</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a class="text-center" href="javascript:void(0);">--}}
                                {{--<strong>See all notifications</strong>--}}
                                {{--<i class="fa fa-angle-right"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown"--}}
                       {{--href="javascript:void(0);">--}}
                        {{--<i class="icon-calender"></i>--}}
                        {{--<span class="badge badge-xs badge-danger">3</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu dropdown-tasks animated slideInUp">--}}
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);">--}}
                                {{--<div>--}}
                                    {{--<p>--}}
                                        {{--<strong>Task 1</strong>--}}
                                        {{--<span class="pull-right text-muted">40% Complete</span>--}}
                                    {{--</p>--}}
                                    {{--<div class="progress progress-striped active">--}}
                                        {{--<div class="progress-bar progress-bar-success" role="progressbar"--}}
                                             {{--aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"--}}
                                             {{--style="width: 40%">--}}
                                            {{--<span class="sr-only">40% Complete (success)</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);">--}}
                                {{--<div>--}}
                                    {{--<p>--}}
                                        {{--<strong>Task 2</strong>--}}
                                        {{--<span class="pull-right text-muted">20% Complete</span>--}}
                                    {{--</p>--}}
                                    {{--<div class="progress progress-striped active">--}}
                                        {{--<div class="progress-bar progress-bar-info" role="progressbar"--}}
                                             {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"--}}
                                             {{--style="width: 20%">--}}
                                            {{--<span class="sr-only">20% Complete</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);">--}}
                                {{--<div>--}}
                                    {{--<p>--}}
                                        {{--<strong>Task 3</strong>--}}
                                        {{--<span class="pull-right text-muted">60% Complete</span>--}}
                                    {{--</p>--}}
                                    {{--<div class="progress progress-striped active">--}}
                                        {{--<div class="progress-bar progress-bar-warning" role="progressbar"--}}
                                             {{--aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"--}}
                                             {{--style="width: 60%">--}}
                                            {{--<span class="sr-only">60% Complete (warning)</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);">--}}
                                {{--<div>--}}
                                    {{--<p>--}}
                                        {{--<strong>Task 4</strong>--}}
                                        {{--<span class="pull-right text-muted">80% Complete</span>--}}
                                    {{--</p>--}}
                                    {{--<div class="progress progress-striped active">--}}
                                        {{--<div class="progress-bar progress-bar-danger" role="progressbar"--}}
                                             {{--aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"--}}
                                             {{--style="width: 80%">--}}
                                            {{--<span class="sr-only">80% Complete (danger)</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li>--}}
                            {{--<a class="text-center" href="javascript:void(0);">--}}
                                {{--<strong>See All Tasks</strong>--}}
                                {{--<i class="fa fa-angle-right"></i>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="right-side-toggle">--}}
                    {{--<a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="javascript:void(0)">--}}
                        {{--<i class="icon-settings"></i>--}}
                    {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
    <!-- ===== Top-Navigation-End ===== -->
    <!-- ===== Left-Sidebar ===== -->

@yield('sidebar-left')

<!-- ===== Left-Sidebar-End ===== -->
    <!-- ===== Page-Content ===== -->

    <div class="page-wrapper">
        {{--@if (count($errors) > 0)--}}

        {{--@foreach ($errors->all() as $error)--}}
        {{--<div class="alert alert-danger">{{ $error }}</div>--}}
        {{--@endforeach--}}




        {{--@endif--}}

        {{--@if (session('status'))--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}


        {{--<div class=" alert alert-success">{{ session('status') }}</div>--}}



        {{--</div>--}}
        {{--</div>--}}


        {{--@endif--}}
        @yield('content')

        <footer class="footer t-a-c">
            © 2017-{{date('Y')}} Lararent Admin
        </footer>
    </div>
    <!-- ===== Page-Content-End ===== -->
</div>
<!-- ===== Main-Wrapper-End ===== -->
<!-- ==============================
    Required JS Files
=============================== -->

{!! $lr_footer ?? '' !!}
<script>

    if (typeof Dropzone !== "undefined") {
        Dropzone.autoDiscover = false;
    }

</script>

{{--<!-- ===== Plugin JS ===== -->--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/chartist-js/dist/chartist.min.js"></script>--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>--}}

{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/sparkline/jquery.sparkline.min.js"></script>--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/sparkline/jquery.charts-sparkline.js"></script>--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/knob/jquery.knob.js"></script>--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/easypiechart/dist/jquery.easypiechart.min.js"></script>--}}


{{--<script src="{{ asset(config('settings.admin')) }}/js/db1.js"></script>--}}
<!-- ===== Style Switcher JS ===== -->

{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>--}}
{{--<script src="{{ asset(config('settings.admin')) }}/plugins/components/datatables/jquery.dataTables.min.js"></script>--}}


<script>
    jQuery(document).ready(function ($) {
        //  $('#myTable').DataTable();

        /* var table = $('#example').DataTable({
             "columnDefs": [{
                 "visible": false,
                 "targets": 2
             }],
             "order": [
                 [2, 'asc']
             ],
             "displayLength": 2,
             "drawCallback": function(settings) {
                 var api = this.api();
                 var rows = api.rows({
                     page: 'current'
                 }).nodes();
                 var last = null;
                 api.column(2, {
                     page: 'current'
                 }).data().each(function(group, i) {
                     if (last !== group) {
                         $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                         last = group;
                     }
                 });
             }
         });
         // Order by the grouping
         $('#example tbody').on('click', 'tr.group', function() {
             var currentOrder = table.order()[0];
             if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                 table.order([2, 'desc']).draw();
             } else {
                 table.order([2, 'asc']).draw();
             }
         });*/
    });
    /* $('#example23').DataTable({
         dom: 'Bfrtip',
         buttons: [
             'copy', 'csv', 'excel', 'pdf', 'print'
         ]
     });*/
</script>
</body>

</html>
