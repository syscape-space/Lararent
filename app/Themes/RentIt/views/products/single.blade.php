@if (count($errors) > 0)

    <div class="row">
        <div class="col-md-12">
            @foreach ($errors->all() as $error)

                <div class="alert alert-danger fade in">
                    <button class="close" data-dismiss="alert" type="button">×</button>
                    <strong>{{ $error }}</strong></div>
            @endforeach

        </div>

    </div>
@endif

@if (session('status'))
    <div class="row">
        <div class="col-md-12">


            <div class=" alert alert-success">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <strong>{{ session('status') }}</strong></div>


        </div>
    </div>


@endif

<h3 class="block-title alt"><i class="fa fa-angle-down"></i>{{__('Car Information')}}</h3>
<div class="car-big-card alt">
    <div class="row">


        <div class="col-md-8">
            <div class="owl-carousel img-carousel">

                @if( $product->img ?? false )

                    <div class="item">
                        <a class="btn btn-zoom" href="{{ the_image_url($product->img,'thumbnail-370x220') }}"
                           data-gal="prettyPhoto"><i class="fa fa-arrows-h"></i></a>
                        <a href="{{ the_image_url($product->img,'full') }}" data-gal="prettyPhoto">
                            <img class="img-responsive" src="{{ the_image_url($product->img,'thumbnail-600x426') }}"
                                 alt=""/></a>
                    </div>
                @endif
                @if( is_array($gallery_media) && !empty($gallery_media) )

                    @foreach($gallery_media as $k => $item)
                        @if($k  < 3)
                            <div class="item">

                                <a class="btn btn-zoom" href="{{ the_image_url($item)}}" data-gal="prettyPhoto"><i
                                            class="fa fa-arrows-h"></i></a>
                                <a href="{{ the_image_url($item,'thumbnail-600x426')}}" data-gal="prettyPhoto">
                                    <img
                                            class="img-responsive" src="{{ the_image_url($item,'thumbnail-600x426')}}"
                                            alt=""/></a>
                            </div>
                        @endif
                    @endforeach


                @endif

            </div>
            <div class="row car-thumbnails">
                @if( $product->img ?? false )

                    <div class="col-xs-2 col-sm-2 col-md-3">
                        <a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0,300]);">
                            <img src="{{ the_image_url($product->img,'thumbnail-70x70') }}" alt=""/></a>
                    </div>
                @endif
                @if( is_array($gallery_media) && !empty($gallery_media) )

                    @foreach($gallery_media as $k => $item)
                        @if($k  < 3)
                            <div class="col-xs-2 col-sm-2 col-md-3">
                                <a href="#"
                                   onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [{{$k+1}},300]);">
                                    <img src="{{ the_image_url($item,'thumbnail-70x70') }}" alt=""/></a>
                            </div>
                        @endif
                    @endforeach


                @endif

            </div>
        </div>
        <div class="col-md-4">
            <div class="car-details">
                <div class="list">
                    <ul>
                        <li class="title">
                            <h2> <?php
								$arr = explode( ' ', $product->title );
								$arr[count( $arr ) - 1] = '<span>' . $arr[count( $arr ) - 1] . '</span>';
								echo implode( $arr, ' ' );

								?></h2>

                        </li>
                        @if(isset($product_meta['attributes']{1}))
							<?php $attr = json_decode( $product_meta['attributes'] );
							if($attr){ ?>
                            @foreach($attr->value as $item)
                                <li>{{$item}}</li>
                            @endforeach
							<?php  } ?>
                        @endif


                    </ul>
                </div>
             
                <div class="price">
                    <strong>{!!   ec_price($price)!!}</strong> <span>{{__('/for 1 day(s)')}}</span> <i class="fa fa-info-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="page-divider half transparent"/>

<p>{!! $product->text ?? '' !!}</p>

<form action="{{route('products.store')}}" method="POST" class="form-booking_a_car">
    @csrf
    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>
        {{__('Extras & Frees')}}
    </h3>
    <div role="form" class="form-extras">

        <div class="row">


            @if(isset($product_meta['_rental_resource']) && $rental_resource = json_decode($product_meta['_rental_resource']) )
				<?php




				$collection = [];
				if(isset($rental_resource->item_name)){
				?>
                @foreach($rental_resource->item_name as $j => $name)
					<?php
					$checked = false;
					$disable = false;

					$duration_type = '';
					if ( $rental_resource->duration_type[$j] == 'hours' )
						$duration_type = __( 'Hour' );
					if ( $rental_resource->duration_type[$j] == 'days' )
						$duration_type = __( 'Days' );

					if ( $rental_resource->duration_type[$j] == 'Total' )
						$duration_type = __( 'Total' );

					if ( $rental_resource->duration_type[$j] == 'Included' )
						$duration_type = __( 'Included' );

					if ( $rental_resource->duration_type[$j] == 'fixed_change' )
						$duration_type = __( 'Fixed change' );


					$collection[] = [
						'id' => $j,
						'item_name' => $name,
						'quantity' => $rental_resource->quantity[$j] ?? '',
						'cost' => $rental_resource->cost[$j] ?? '',
						'duration_type' => $rental_resource->duration_type[$j] ?? '',
						'type' => $duration_type,
						'checked' => $checked,
						'disable' => $disable

					];  ?>
                @endforeach
				<?php

				$quantity = count( $collection );

				$collection1 = array_slice( $collection, 0, intval( ceil( $quantity / 2 ) ), true );
				$collection2 = array_diff_key( $collection, $collection1 );


				?>


                <div class="col-md-6">
                    <div class="left">
						<?php  $i = 0; ?>
                        @if($collection1)

                            @foreach($collection1 as $item)


                                <div class="checkbox checkbox-danger">
                                    <input name="checkbox_extras[<?php echo( $i ); ?>]"

                                           id="checkbox_{{$item['item_name']}}" type="checkbox"
									       <?php if ( $item['checked'] == true ) {
										       echo 'checked="" value="on"';
									       } ?>
									       <?php if ( $item['disable'] == true ) { ?>
                                           disabled="disabled"
									<?php } ?>

                                    >
                                    <label for="checkbox_{{$item['item_name']}}">{{$item['item_name']}}<span
                                                class="pull-right">
                                    {{formatted_price($item['cost'])}} / {{$item['type']}}</span></label>
                                </div>
								<?php  $i ++; ?>
                            @endforeach
                        @endif

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="right">
                        @if($collection1)
                            @foreach($collection2 as $item)
								<?php   ?>
                                <div class="checkbox checkbox-danger">
                                    <input name="checkbox_extras[<?php echo( $i ); ?>]"
                                           id="checkbox_{{$item['item_name']}}" type="checkbox"
									       <?php if ( $item['checked'] == true ) {
										       echo 'checked="" value="on"';
									       } ?>
									       <?php if ( $item['disable'] == true ) { ?>
                                           disabled="disabled"
									<?php } ?>

                                    >
                                    <label for="checkbox_{{$item['item_name']}}">{{$item['item_name']}}
                                        <span class="pull-right">{{formatted_price($item['cost'])}}
                                            / {{$item['type']}}</span></label>
                                </div>
									<?php  $i ++; ?>
                            @endforeach
                        @endif

                    </div>
                </div>
                <?php  } ?>
            @endif

        </div>

    </div>


    <div class="row row-inputs">
        <div class="">
			<?php

			$picking_up_location = json_decode( $product_meta['__picking_up_location'] ?? '' );
			$dropping_off = json_decode( $product_meta['__dropping_off_location'] ?? '' );

			?>
            <div class="col-sm-6">
                <div class="form-group has-icon has-label">
                    <label for="formSearchUpLocation">{{__('Picking Up Location')}}</label>
                    <select name="PickingUpLocation"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="Select">
                        @if($locations)
                            @foreach($locations as $location)

                                @if( is_array($picking_up_location) && in_array($location->alias,  $picking_up_location) )
                                    <option
										<?php  selected( old( 'PickingUpLocation', session('PickingUpLocation') ), $location->alias ); ?>
                                        value="{{$location->alias}}">{{$location->title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-icon has-label">
                    <label for="formSearchUpDate">{{__('Picking Up Date')}}</label>
                    <input autocomplete="off" type="text"
                           class="form-control PickingUpDate"
                           id="formSearchUpDate3"
                           value="{{old('PickingUpDate', session('PickingUpDate'))}}"
                           placeholder="{{get_theme_mod('rentit_calendar_format', 'MM/DD/YYYY')}}"
                           name="PickingUpDate"

                    >
                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>{{__('Picking Up Hour')}}</label>
                    <select
                            name="PickingUpHour"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="Select">

						<?php  $times = rentit_get_times(); ?>
                        @if($times && is_array($times))
                            @foreach($times as $time)
                                <option
									<?php  selected( old( 'PickingUpHour',session('PickingUpHour') ), $time ); ?> value="{{$time}}">{{$time}}</option>
                            @endforeach
                        @endif

                    </select>
                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-inputs">
        <div class="">
            <div class="col-sm-6">
                <div class="form-group has-icon has-label">
                    <label for="formSearchOffLocation">{{__('Dropping Off Location')}}</label>
                    <select name="DroppingOffLocation"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="Select">
                        @if($locations)
                            @foreach($locations as $location)

                                @if( is_array($dropping_off) && in_array($location->alias,  $dropping_off) )
                                    <option
										<?php  selected( old( 'DroppingOffLocation', session('DroppingOffLocation') ), $location->alias ); ?>
                                        value="{{$location->alias}}">{{$location->title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-icon has-label">
                    <label for="formSearchOffDate">{{__('Dropping Off Date')}}</label>
                    <input autocomplete="off"  value="{{old('DroppingOffDate',session('DroppingOffDate'))}}" name="DroppingOffDate" type="text" class="DroppingOffDate form-control "
                           id="formSearchOffDate3"
                           placeholder="{{get_theme_mod('rentit_calendar_format', 'MM/DD/YYYY')}}">
                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>{{__('Dropping Off Hour')}}</label>
                    <select name="DroppingOffHour"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="Select">
                        @if($times && is_array($times))
                            @foreach($times as $time)
                                <option
									<?php  selected( old( 'DroppingOffHour',session('DroppingOffHour') ), $time ); ?> value="{{$time}}">{{$time}}</option>
                            @endforeach
                        @endif

                    </select>
                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="">--}}
    {{--<div class="row row-inputs">--}}
    {{--<div class="">--}}
    {{--<div class="col-sm-12">--}}
    {{--<div class="form-group has-icon has-label">--}}
    {{--<label for="formSearchUpLocation3">Picking Up Location </label>--}}
    {{--<input autocomplete="off"--}}
    {{--type="text"--}}
    {{--class="form-control formSearchUpLocation2"--}}
    {{--id="formSearchUpLocation3"--}}
    {{--name="dropin_location"--}}
    {{--placeholder="Airport or Anywhere"--}}
    {{--value=""--}}
    {{-->--}}

    {{--<span class="form-control-icon"><i class="fa fa-map-marker"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-12">--}}
    {{--<div class="form-group has-icon has-label">--}}
    {{--<label for="formSearchOffLocation3">Dropping Off Location</label>--}}
    {{--<input autocomplete="off" name="dropoff_location" type="text" class="form-control formSearchUpLocation20" id="formSearchOffLocation3" placeholder="Airport or Anywhere" value="Famagusta">--}}

    {{--<span class="form-control-icon"><i class="fa fa-map-marker"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row row-inputs">--}}
    {{--<div class="">--}}
    {{--<div class="col-sm-6">--}}
    {{--<div class="form-group has-icon has-label">--}}
    {{--<label for="formSearchUpDate3">Picking Up Date</label>--}}
    {{--<input name="dropin_date"--}}
    {{--type="text"--}}
    {{--class="form-control"--}}
    {{--id="formSearchUpDate3"--}}
    {{--placeholder="dd/mm/yyyy"--}}
    {{--value="08/17/2018 9:57"--}}
    {{-->--}}
    {{--<span class="form-control-icon"><i class="fa fa-calendar"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-6">--}}
    {{--<div class="form-group has-icon has-label">--}}
    {{--<label for="formSearchOffDate3">Dropping Off Date</label>--}}
    {{--<input name="dropoff_date" type="text" class="form-control" id="formSearchOffDate3" placeholder="dd/mm/yyyy" value="09/05/2018 9:57">--}}
    {{--<span class="form-control-icon"><i class="fa fa-calendar"></i></span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>{{__('Customer Information')}}</h3>
    <div class="form-delivery">
        <div class="row">
            <div class="col-md-12">
                <div class="radio radio-inline">
                    <input type="radio" <?php  checked( old( 'gender' ), 'Mr' ); ?>  id="inlineRadio1" value="Mr"
                           name="gender" checked="">
                    <label for="inlineRadio1">{{__('Mr')}}</label>
                </div>
                <div class="radio radio-inline">
                    <input type="radio" <?php  checked( old( 'gender' ), 'Ms' ); ?>  id="inlineRadio2" value="Ms"
                           name="gender">
                    <label for="inlineRadio2">{{__('Ms')}}</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input name="name"
                           id="fd-name" title="{{__('Name is required')}}" data-toggle="tooltip"
                           class="form-control alt" type="text" placeholder="{{__('Name and Surname:')}}*">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input name="email"
                           id="fd-email"
                           title="{{__('Email is required')}}"
                           data-toggle="tooltip"
                           class="form-control alt"
                           type="text"
                           value="{{  $errors->has('email') ?? old('email')}}"
                           placeholder="{{__('Your Email Address:*')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input
                            class="form-control alt"
                            name="phone"
                            type="number"
                            value="{{old('phone')}}"
                            placeholder="{{__('Phone Number:')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input
                            class="form-control alt"
                            name="street_address"
                            value="{{old('street_address')}}"
                            type="text"
                            placeholder="{{__('Street address *')}}">
                </div>
            </div>

        </div>
    </div>


    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>{{__('Payments options')}}</h3>
    <div class="panel-group payments-options payment-panel" id="accordion" role="tablist" aria-multiselectable="true">

        <!----------------------------------------------------->


        <!------------------------------------------------------->
        @if($available_gateways  =$PaymentGateways->get_available_payment_gateways())

            @foreach($available_gateways as $gateway)

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                               href="#{{$gateway->id}}"
                               aria-expanded="false" aria-controls="collapseTwo">

                        <span class="dot"><input class="dn" type="radio" name="payment"
                                                 value="{{$gateway->id}}"></span>{{$gateway->method_title}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$gateway->id}}" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="heading2">
                        <div class="panel-body">
                            <div class="alert alert-success" role="alert">
                                {{$gateway->method_description}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        {{--<br><br><br><br><br><br>--}}
        {{--<div class="panel radio panel-default">--}}
        {{--<div class="panel-heading" role="tab" id="headingOne">--}}
        {{--<h4 class="panel-title">--}}
        {{--<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true"--}}
        {{--aria-controls="collapseOne">--}}
        {{--<span class="dot"><input type="radio" name="payment"--}}
        {{--value="DBT"></span> {{__('Direct Bank Transfer')}}--}}

        {{--</a>--}}
        {{--</h4>--}}
        {{--</div>--}}
        {{--<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">--}}
        {{--<div class="panel-body">--}}
        {{--<div class="alert alert-success" role="alert">Lorem ipsum dolor sit amet, consectetur adipiscing--}}
        {{--elit.--}}
        {{--Curabitur sollicitudin ultrices suscipit. Sed commodo vel mauris vel dapibus.--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}



        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" role="tab" id="headingThree">--}}
        {{--<h4 class="panel-title">--}}
        {{--<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3"--}}
        {{--aria-expanded="false" aria-controls="collapseThree">--}}
        {{--<span class="dot"><input class="dn" type="radio"  name="payment"--}}
        {{--value="СС"></span> {{__('Credit Card')}}--}}
        {{--</a>--}}
        {{--<span class="overflowed pull-right">--}}
        {{--<img src="assets/img/preview/payments/mastercard-2.jpg" alt=""/>--}}
        {{--<img src="assets/img/preview/payments/visa-2.jpg" alt=""/>--}}
        {{--<img src="assets/img/preview/payments/american-express-2.jpg" alt=""/>--}}
        {{--<img src="assets/img/preview/payments/discovery-2.jpg" alt=""/>--}}
        {{--<img src="assets/img/preview/payments/eheck-2.jpg" alt=""/>--}}
        {{--</span>--}}
        {{--</h4>--}}
        {{--</div>--}}
        {{--<div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3"></div>--}}
        {{--</div>--}}
        {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading" role="tab" id="heading4">--}}
        {{--<h4 class="panel-title">--}}
        {{--<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4"--}}
        {{--aria-expanded="false" aria-controls="collapse4">--}}
        {{--<span class="dot"><input class="dn" type="radio" name="payment"--}}
        {{--value="PayPal"></span> {{__('PayPal')}}--}}
        {{--</a>--}}
        {{--<span class="overflowed pull-right"><img src="assets/img/preview/payments/paypal-2.jpg"--}}
        {{--alt=""/></span>--}}
        {{--</h4>--}}
        {{--</div>--}}
        {{--<div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4"></div>--}}
        {{--</div>--}}
    </div>

    <h3 class="block-title alt"><i class="fa fa-angle-down"></i>{{__('Additional Information')}}</h3>
    <div class="form-additional">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                                        <textarea name="message" id="fad-message"
                                                  title="{{__('Addition information is required')}}"
                                                  data-toggle="tooltip"
                                                  class="form-control alt"
                                                  placeholder="{{__('Additional Information')}}" cols="30"
                                                  rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="overflowed reservation-now">
        <div class="checkbox pull-left">
            <input id="accept" type="checkbox" name="fd-name" title="Please accept" data-toggle="tooltip">
            <label for="accept">{{__('I accept all information and Payments etc')}}</label>
        </div>
        <input type="hidden" name="product_id" value="{{$product->id ?? ''}}">
        <input type="hidden" name="product_url" value="{{url()->current()}}">
        <button type="submit" class="btn btn-theme pull-right btn-reservation-now"
                href="#">{{__('Reservation Now')}}</button>
        <a class="btn btn-theme pull-right btn-cancel btn-theme-dark" href="#">{{__('Cancel')}}</a>
    </div>


</form>


