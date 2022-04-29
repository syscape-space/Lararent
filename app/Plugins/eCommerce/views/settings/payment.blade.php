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

                    <div class="col-md-12">
                        <h4 class="box-title">{{__('Payment gateway')}}</h4>
                        <div class="form-body">


                            <div class="table-responsive ">

                                <table class="table product-overview " id="myTable">
                                    <thead>
                                    <tr>
                                        <th>{{__('Method')}}</th>
                                        <th>{{__('Enabled')}}</th>
                                        <th>{{__('Description')}} </th>
                                        <th>{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                               
                                    @foreach($gateways as $gateway)
                                        <tr data-gateway_id="{{$gateway->id}}">
                                            <td>

                                                <a href="{{route('admin.ecommerce.payment.edit',['payment' => $gateway->id])}}">
{{$gateway->get_title() ??  __('(no title)')}}
                                                </a>
                                            </td>
                                            <td></td>
                                            <td>

                                              {{ $gateway->get_method_description()}}


                                            </td>

                                            <td>
                                                <a href="{{route('admin.ecommerce.payment.edit',['payment' => $gateway->id])}}" class="text-inverse p-r-10"
                                                   data-toggle="tooltip" title="" data-original-title="Edit"><i
                                                            class="ti-marker-alt"></i></a>


                                        </tr>

                                    @endforeach




                                    </tbody>
                                </table>


                            </div>

                        </div>
                    </div>


                </div>
                <hr>

            </div>
        </div>
    </div>


</div>