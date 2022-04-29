{{--<div class="container-fluid">--}}
    {{--<div class="col-md-12"><h1>{{__('admin.Dashboard')}}</h1></div>--}}
{{--</div>--}}

<!-- ===== Page-Container ===== -->
<div class="container-fluid">
    @action('dashboard.top-widget')
    <div >
        <div class="white-box">
            <div class="text-center">
                <h1 class="">{{__('admin.Welcome to Lararent!')}}  <small>v {{ config('settings.lr_version') }}</small></h1>

                <p>{{__('admin.We’ve assembled some links to get you started:')}}</p></div>

                <div class="row default-steps">
                    <div class="col-md-4 column-step">
                        <div class="step-number">{{__('admin.1')}}</div>
                        <div class="step-title">{{__('admin.Get Started')}}</div>
                        <div class="step-info">

                            <a class="btn  btn-success btn-lg"
                               href="{{route('admin.customize.index')}}">{{__('admin.Customize Your Site')}}</a>

                            <p class="hide-if-no-customize">{{__('admin.or,')}}
                                <a href="{{route('admin.themes.index')}}">{{__('admin.change your theme completely')}}</a></p>

                            <br><br>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-4 column-step active">
                        <div class="step-number">{{__('admin.2')}}</div>
                        <div class="step-title">{{__('admin.Next Steps')}}</div>
                        <div class="step-info">
                            <div class="list-group">

                                <a href="{{route('admin.pages.create')}}" class="list-group-item active">{{__('admin.Add additional pages')}}</a>
                                <a href="{{route('admin.posts.create')}}" class="list-group-item active">{{__('admin.Add additional posts')}}</a>
                                <a href="{{ url('/') }}" class="list-group-item active">{{__('admin.View your site')}}</a>
                            </div>

                       </div>
                    </div>
                    <div class="col-md-4 column-step">
                        <div class="step-number">{{__('admin.3')}}</div>
                        <div class="step-title">{{__('admin.More Actions')}}</div>
                        <div class="step-info">
                            <div class="list-group">
                                <span class="list-group-item active">
                                   {{__('admin.Manage')}} <a href="{{route('admin.widgets.index')}}" class="text-white">
                                        {{__('admin.widgets')}}</a> {{__('admin.or')}}  <a href="{{route('admin.menus.index')}}" class="text-white">{{__('admin.menus')}}</a>
                                </span>


                                <a href="{{route('admin.users.index')}}" class="list-group-item">{{__('admin.Manage users')}}</a>
                                <a href="{{route('admin.options.index')}}" class="list-group-item">{{__('admin.Change options')}}</a>
                            </div>

                      </div>
                    </div>


        </div>
    </div>
    <!-- ===== Right-Sidebar-End ===== -->
</div>
    @action('dashboard.bottom-widget')
</div>

<!-- ===== Page-Container-End ===== -->