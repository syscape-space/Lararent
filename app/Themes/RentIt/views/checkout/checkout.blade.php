<div class="col-md-12 col-xs-12">
    <div class="white-box">
        <h3 class="block-title alt"><b>{{__('Order items')}}</b></h3>
        <form action="{{route('FrontendCheckoutCharge')}}" method="POST" class="table-responsive">

            @csrf

            @if($product->alias ?? false && $ecommerce_cart)

                <table class="table table-bordered shop_table shop_table_responsive cart">

                    <thead>
                    <tr>
                        <th>{{__('item')}}</th>
                        <th></th>
                        <th>{{__('Cost')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Total')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="col-md-1">
                            @if($product->img > 0)
                                <img class="" style="margin-right: 10px;"
                                     src="{{ the_image_url($product->img,'thumbnail-260x260') }}"
                                     alt="{{$product->title}}" width="80">
                            @endif

                        </td>
                        <td>
                            <div class="form-group">
                                <a href="{{ route('products.show',['alias' => $product->alias]) }}">
                                    {{$product->title}}
                                </a>
                            </div>
                            <div class="clearfix"></div>


                            <table class="table table-bordered shop_table shop_table_responsive cart">
								<?php
								$star_date = ( $ecommerce_cart['PickingUpDate'] . ' ' . $ecommerce_cart['PickingUpHour'] );
								if ( isset( $ecommerce_cart['DroppingOffDate'] ) && isset( $ecommerce_cart['DroppingOffHour'] ) ) {

									$end_date = $ecommerce_cart['DroppingOffDate'] . ' ' . $ecommerce_cart['DroppingOffHour'];
								} else {
									$end_date = 0;
								}

								$days = rentit_DateDiff( 'd', strtotime( $star_date ), strtotime( $end_date ) );
								$hour = rentit_DateDiff( 'h', strtotime( $star_date ), strtotime( $end_date ) );


								?>
                                <tbody>
                                <tr>
                                    @if($hour < 24)
                                        <td> {{__('Hour(s)')}} : {{$hour}}</td>
                                    @else
                                        <td> {{__('Day(s)')}} : {{$days}}</td>
                                    @endif

                                </tr>

                                @if($ecommerce_cart['names']['extras'] ?? false)
                                    <tr>
                                        <td><b>{{__('Extras & Frees')}}</b></td>
                                    </tr>
                                    @foreach($ecommerce_cart['names']['extras'] as $item)
                                        <tr>
                                            <td> &nbsp;&nbsp;{{$item['name']}}: {{formatted_price($item['price'])}}</td>
                                        </tr>
                                    @endforeach
                                @endif

                                <tr>
                                    <td><b> {{__('Rent data')}}</b></td>
                                </tr>

                                <tr>

                                    <td>&nbsp;&nbsp;<b>{{__('Start')}}</b> {{$star_date}}
                                        <b>: </b><b>{{__('End')}} </b>{{$end_date}}</td>

									<?php
									$date = DateTime::createFromFormat( 'm/d/y H:i  A', '09/30/18 10:00 AM' );
									//       echo  $date->format('m/d/y H:i');


									?>

                                </tr>
                                <tr>
                                    <td><b>{{__('Picking Up Location')}}
                                            :</b> {{ get_locations_from_slug($ecommerce_cart['PickingUpLocation']) }}
                                    </td>
                                </tr>
                                @if(isset($ecommerce_cart['DroppingOffLocation']))
                                    <tr>
                                        <td><b>{{__('Dropping Off Location')}}
                                                :</b> {{ get_locations_from_slug($ecommerce_cart['DroppingOffLocation'] ?? '')}}
                                        </td>

                                    </tr>
                                @endif
                                <tr>
                                    <td>
                                        {{$ecommerce_cart['gender']}}<br>
                                        {{$ecommerce_cart['name']}}<br>
                                        {{$ecommerce_cart['street_address']}}<br>
                                        {{$ecommerce_cart['email']}}<br>
                                        {{$ecommerce_cart['phone']}}<br>
                                    </td>
                                    {{--<td><b>Location charge </b> : Free</td>--}}
                                </tr>
								<?php

								$product = \Corp\Plugins\eCommerce\Models\Product::where( 'id', $ecommerce_cart['product_id'] )->first();

								$product_meta = getProductMetas( $product );
								if(isset( $product_meta['rentit_deposit_percent'] )){

								?>

                                <tr>
                                    <td>
                                        <b> {{ __('Deposit percent is')  }}</b>
                                        {{$product_meta['rentit_deposit_percent']}} %

                                    </td>
                                    {{--<td><b>Location charge </b> : Free</td>--}}
                                </tr>
                                <tr>
                                    <td>
                                        <b> {{ __('Full price')  }}</b>
                                        {{formatted_price($ecommerce_cart['full_price']) }}

                                    </td>
                                    {{--<td><b>Location charge </b> : Free</td>--}}
                                </tr>
								<?php }  ?>


                                </tbody>
                            </table>
                            <div class="row">

                                <div class="col-md-9">
                                    <input type="text" name="coupon_code" class="input-text pull-left
                               form-control placeholder" id="coupon_code" value="" placeholder="Coupon code">
                                </div>
                                <div class="col-md-3">
                                    <button style="height: 50px;" type="button"
                                            class="btn btn-theme pull-right btn-apply-coupon">
                                        Apply Coupon
                                    </button>
                                </div>

                            </div>

                        </td>
                        <td>{{ formatted_price($ecommerce_cart['total_price'])}}</td>
                        <td>1</td>
                        <td class="font-500">{{ formatted_price($ecommerce_cart['total_price'])}}</td>
                        <td><a href="javascript:void(0)" class="text-inverse" title="" data-toggle="tooltip"
                               data-original-title="Delete"><i class="ti-trash"></i></a>


                        </td>
                    </tr>


                    <tr>
                        <td colspan="5" style="font-size: 120%;" class="font-500" align="right"><b>{{__('Total')}}</b>
                        </td>
                        <td class="font-500 cart-total"
                            style="font-size: 120%;">{{ formatted_price($ecommerce_cart['total_price'])}}</td>
                    </tr>

                    </tbody>
                </table>
                <br>


                <br>
                <div class="form-group">

                    @if(is_object($gateway))
                        {!! $gateway->checkout_bottom($product, $ecommerce_cart) !!}
                    @endif


                    <button type="submit" class="btn btn-theme pull-right btn-reservation-now"
                            href="#">{{__('Place order')}}
                    </button>
                </div>
            @else
                <h4>{{__('Checkout is empty!')}}</h4>

            @endif

        </form>
        @if(is_object($gateway) && method_exists($gateway,'afterCheckoutForm'))
            {!! $gateway->afterCheckoutForm($product, $ecommerce_cart) !!}
        @endif
        <style>
            .stripe-button-el {
                display: none;
            }
        </style>
    </div>
</div>