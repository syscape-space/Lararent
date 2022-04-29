<div class="row">
    <div class="col-md-3">
        <div class="widget shadow car-categories">

            <div class="widget-content">

                <ul>
                    <li>
                        <span class="arrow"></span><a
                                href="{{route('MyAccount')}}">{{__('My bookings')}}</a>

                    </li>
                    <li>
                        <a
                                href="{{route('MyAccountEdit')}}">{{__('Edit account')}}</a>

                        <ul class="children" style="display: none;"></ul>
                    </li>
                    <li>

                        <a
                                href="{{route('logout')}}">{{__('Log out')}}</a>

                        <ul class="children" style="display: none;"></ul>
                    </li>
                </ul>

            </div>
        </div>

    </div>

    <div class="col-md-9">

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
        @if($orders ?? false && !$orders->isEmpty())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{__('Item')}}</th>
                    <th></th>
                    <th>{{__('Cost')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Total')}}</th>
                    <th>{{__('Status')}}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)

                    @if($order->items)
                        @foreach($order->items as $item)

                            <tr>
                                <td class="col-md-1">
                                    @if($item->product->img ?? false && the_image_url($item->product->img,'thumbnail-70x70') )
                                        <img class="" style="margin-right: 10px;"
                                             src="{{the_image_url($item->product->img,'thumbnail-70x70')}}"
                                             alt="{{$item->product->title}}" width="80">
                                    @endif


                                </td>
                                <td>
                                    <div class="form-group">
                                        <a href="{{route('admin.products.edit',['product' => $order->items->first()->product->id])}}">
                                            {{$item->product->title}}
                                        </a>
                                    </div>
                                    <div class="clearfix"></div>

                                    <table class="col-md-12 ">

                                        <tbody>


                                        @foreach($item->meta as $meta)
                                            @if($meta->key == 'PickingUpDate' || $meta->key == 'DroppingOffDate')
                                                <tr>
                                                    <th class="col-md-6">{{$meta->title ?? ''}}</th>
                                                    <td class="col-md-6">
                                                        {{ $meta->value }}
                                                    </td>
                                                </tr>
                                            @elseif($meta->key == 'DroppingOffLocation' || $meta->key == 'PickingUpLocation')

                                                <tr>
                                                    <th class="col-md-6">{{( $meta->title ?? '')}}</th>
                                                    <td class="col-md-6">{{get_locations_from_slug($meta->value ?? '')}}
                                                    </td>
                                                </tr>
                                            @elseif($meta->key == 'extras')

                                                <tr>
                                                    <th>{{__('Extras')}}<br></th>
                                                    <td>@foreach (unserialize($meta->value ) as $e)
                                                            {{$e}} <br>
                                                        @endforeach
                                                        <br>
                                                    </td>
                                                </tr>
                                            @elseif($meta->key !== '')
                                                <tr>
                                                    <th class="col-md-6">{{$meta->title ?? ''}}</th>
                                                    <td class="col-md-6">{{$meta->value ?? ''}}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach


                                        </tbody>
                                    </table>
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td class="font-500">{{$order->total_price}}</td>
                                <td>{{$order->status}} <br>
                                    @if(get_theme_mod('rentit_booking_cancel',true))
                                        <a href="{{route('MyAccountCancelOrder',['id' => $order->id])}}">cancel order</a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    @endif


                @endforeach

                </tbody>
            </table>


        @endif

    </div>

</div>

