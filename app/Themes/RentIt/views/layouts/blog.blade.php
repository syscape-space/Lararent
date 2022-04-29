@include('theme:rentit::layouts.header')

<!-- CONTENT AREA -->
<div class="content-area">

    <!-- BREADCRUMBS -->

@yield('breadcrumbs')

<!-- /BREADCRUMBS -->

    <!-- PAGE WITH SIDEBAR -->
    @section('content-area')
        <section class="page-section with-sidebar sub-page">
            <div class="container">
                <div class="row">
                    <!-- SIDEBAR -->

                    @if($sidebar ?? false)
                        <aside class="col-md-3 sidebar" id="sidebar">
                            @yield('sidebar')

                        </aside>
                    @endif
                <!-- /SIDEBAR -->

                    <!-- CONTENT -->
                    <div class="{{ (isset($sidebar) || isset($sidebar_right)) ? 'col-md-9' : 'col-md-12'}} content" id="content">

                        @yield('content')

                    </div>

                    @if($sidebar_right ?? false)
                        <aside class="col-md-3 sidebar" id="sidebar">
                         {!! $sidebar_right !!}

                        </aside>
                @endif
                <!-- /CONTENT -->

                </div>
            </div>
        </section>
        <!-- /PAGE WITH SIDEBAR -->
    @endsection
    @yield('content-area')

</div>
<!-- /CONTENT AREA -->

<!-- FOOTER -->


@yield('footer')

<!-- /FOOTER -->

<div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /WRAPPER -->

{!!   $lr_footer ?? '' !!}
</body>
</html>