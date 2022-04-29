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
                        >
                            {{__('Payments')}}
                        </a>
                    </li>


                </ul>
                <hr>
                <div class="row">

                    <div class="col-md-12">
                        @if (count($errors) > 0)

                            <div class="row">
                                <div class="col-md-12">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach

                                </div>

                            </div>
                        @endif

                        @if (session('status'))
                            <div class="row">
                                <div class="col-md-12">


                                    <div class=" alert alert-success">{{ session('status') }}</div>


                                </div>
                            </div>


                        @endif

                        <h4 class="box-title">{{$gateway->method_title}}</h4>
                        <p>{{$gateway->method_description}}</p>
                        <div class="form-body">

                            <form method="post" action="{{route('admin.ecommerce.payment.update',['payment'=>$id])}}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">


                                <div class="form-body">


                                    @foreach($form_fields as $k => $item)
                                        {!! $gateway->formGroup($id, $k, $item)  !!}
                                    @endforeach


                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
                                        {{__('Save options')}}
                                    </button>


                                </div>
                            </form>

                        </div>
                    </div>


                </div>
                <hr>

            </div>
        </div>
    </div>


</div>
<script>
    jQuery(document).ready(function ($) {


        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
    });


</script>