<div class="container-fluid">
    <!-- row -->

    <!--/.row -->
    <!-- /row -->
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <h2 class=""><b>{{__('Settings')}}</b></h2>


                <ul class="nav nav-tabs">
                    <li role="presentation"
                        @if(url()->current() == route('admin.ecommerce.settings.index') )
                        class="active"
                            @endif
                    >
                        <a href="{{route('admin.ecommerce.settings.index')}}"
                           aria-controls="home"
                        >
                            {{__('General')}}
                        </a>
                    </li>
                    <li role="presentation"

                        @if(url()->current() == route('admin.ecommerce.payment.index') )
                        class="active"
                            @endif

                    >
                        <a href="{{route('admin.ecommerce.payment.index')}}" aria-controls="home"
                        >{{__('Payments')}}

                        </a>
                    </li>
                    <li role="presentation"

                        @if(url()->current() == route('admin.ecommerce.email.index') )
                        class="active"
                            @endif

                    >
                        <a href="{{route('admin.ecommerce.email.index')}}" aria-controls="home"
                        >{{__('Emails')}}

                        </a>
                    </li>


                </ul>
                <hr>
                <div class="row">
                    {!! $content_row ?? '' !!}

                </div>
                <hr>

            </div>
        </div>
    </div>


</div>