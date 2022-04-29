<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{  (isset($product->id)) ?  __('admin.Edit product') :  __('admin.Add product')}}
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="POST"
                              action="{{  (isset($product->id)) ? route('admin.products.update',['products'=>$product->id]) : route('admin.products.store')  }}">

                            {{ csrf_field()  }}


                            @if(isset($product->id))
                                <input type="hidden" name="_method" value="PUT">

                            @endif
                            <div class="form-body">
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


                            <!--/row-->
                                <div class="row">
                                    <div class="col-md-9">

                                        <h3 class="box-title">{{__("About Product")}}</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__("Product Name")}}</label>
                                                    <input
                                                            name="title"
                                                            type="text"
                                                            id="firstName"
                                                            class="form-control"
                                                            placeholder="Rounded Chair"
                                                            value="{{  old('title', isset($product->title) ? $product->title : '' )  }}"
                                                    ></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{__(" alias")}}</label>
                                                    <input name="alias" type="text" id="alias" class="form-control"
                                                           placeholder=""
                                                           value="{{  old('alias', isset($product->alias) ? $product->alias : '' )  }}"

                                                    ></div>
                                            </div>
                                            @if($product ?? false)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">{{__(" Permalink")}}</label>
                                                        <a target="_blank"
                                                           href="{{route('products.show',['products'=> $product->alias ])}}">{{route('products.show',['products'=> $product->alias ])}}</a>
                                                    </div>
                                                </div>
                                        @endif
                                        <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <!--/row-->
                                        <h3 class="box-title m-t-40">{{__("Product short Description")}}</h3>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                             <textarea name="desc" class="desc form-control"
                                                       rows="4">{{  old('desc', isset($product->desc) ? $product->desc : '' )  }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="box-title m-t-40">{{__("Product Description")}}</h3>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                     <textarea name="text" class="text form-control"
                                                               rows="4">{{  old('text', isset($product->text) ? $product->text : '' )  }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__("Price")}}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="ti-money"></i></div>
                                                        <input type="text" class="form-control"
                                                               placeholder=""
                                                               name="price"
                                                               value="{{  old('price', isset($product->price) ? $product->price : '' )  }}"

                                                        ></div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__("Deposit percent %")}}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><i class="ti-cut"></i></div>
                                                        <input type="text"
                                                               class="form-control"
                                                               name="rentit_deposit_percent"
                                                               value="{{$product_meta['rentit_deposit_percent'] ?? ''}}"


                                                        ></div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{__("Meta Description")}}</label>
                                                    <input type="text"
                                                           value="{{  old('meta_desc', isset($product->meta_desc) ? $product->meta_desc : '' )  }}"
                                                           name="meta_desc" class="form-control"></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>{{__("Meta Keyword")}}</label>
                                                    <input
                                                            value="{{  old('keywords', isset($product->keywords) ? $product->keywords : '' )  }}"
                                                            type="text"
                                                            name="keywords"
                                                            class="form-control">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-12">

                                            <div class="row">
                                                <!-- Навигация -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="active"><a href="#attributes" aria-controls="home"
                                                                          role="tab" data-toggle="tab">{{__("Attributes")}}</a>
                                                    </li>
                                                    <li><a href="#resources" aria-controls="resources" role="tab"
                                                           data-toggle="tab">{{__("Resources")}}</a></li>
                                                    <li><a href="#season_price" aria-controls="messages" role="tab"
                                                           data-toggle="tab">{{__('Season price')}}
                                                        </a></li>


                                                    {{--<li><a href="#settings" aria-controls="settings" role="tab"--}}
                                                           {{--data-toggle="tab">{{__('Charge locations')}}--}}
                                                        {{--</a></li>--}}
                                                    <li><a href="#rental_location" aria-controls="rental_location"
                                                           role="tab"
                                                           data-toggle="tab">{{__('Rental locations')}}
                                                        </a></li>
                                                </ul>
                                                <!-- Содержимое вкладок -->
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="attributes">

                                                        <div class="col-md-6">
                                                            <h3 class="box-title m-t-40">{{__("GENERAL INFO")}}</h3>

                                                            <div class="table-responsive">
                                                                <table class="table color-table purple-table">
                                                                    <tbody class="resources-table">

																	<?php  try { ?>
                                                                    @if(isset($product_meta['attributes']) ?? isset($items->value))
																		<?php

																		$items = json_decode( $product_meta['attributes'] );

																		?>


                                                                        @foreach($items->value as $k => $item)
                                                                            @include('plugin:eCommerce::products.attributes', compact('k','item'))

                                                                        @endforeach
                                                                    @endif
																	<?php  } catch ( Exception $e ) {

																	} ?>


                                                                    </tbody>
                                                                </table>

                                                                <button data-tr='@include('plugin:eCommerce::products.attributes',['k'=> null, 'item' => null ])'
                                                                        class="add-new-attributes btn btn-info waves-effect waves-light">
                                                                    <span><i class="ion-upload m-r-5"></i>{{__(" Add new Attributes ")}}</span>

                                                                </button>

                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3 class="box-title m-t-40">{{__("Product icons")}}</h3>
                                                            <hr style="margin-top: 0px;">
                                                            <div class="form-group social-button-items-all">

																<?php
																$product_icons = unserialize( $product_meta['product_icons'] ?? '' );

																if ( is_array( $product_icons ) && $product_icons['icon'] ?? false && $product_icons['text'] ?? false) {
																$product_icons = array_combine( $product_icons['icon'], $product_icons['text'] );


																$j = 0;
																foreach ( $product_icons as $k => $text ) {
																?>

                                                                <div class="social-button-items">
                                                                    <div class="col-md-1">
                                                                        <div class="entry input-group  social-icon-group row ">
	                                                    	        <span class="input-group-btn">
	                                                    	            <button
                                                                                name="product_icons[icon][]"
                                                                                class="btn btn-block btn-info"
                                                                                data-iconset="fontawesome"
                                                                                data-icon="{{$k}}"
                                                                                role="iconpicker">
	                                                    	                </button>
	                                                            	</span>

                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-7  ">
                                                                        <div class="row entry input-group  social-icon-group">
                                                                            <input name="product_icons[text][]"
                                                                                   type="text"
                                                                                   placeholder="Diesel"
                                                                                   class="form-control"
                                                                                   value="{{$text}}">

                                                                            <span class="input-group-btn">

                                <?php if ( $j > 0 ) { ?>
                                                                                <button class="btn btn-danger btn-delete"
                                                                                        type="button">
                                     <span class="glyphicon glyphicon-minus"></span>
                                </button>
																				<?php } else { ?>
                                                                                <button class="btn btn-success btn-add"
                                                                                        type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
																				<?php } ?>
                        </span>


                                                                        </div>

                                                                    </div>
                                                                    <div class="clearfix"></div>

                                                                </div>

																<?php
																$j ++;

																}
																} else { ?>


                                                                <div class="social-button-items">
                                                                    <div class="col-md-1">
                                                                        <div class="entry input-group  social-icon-group row ">
	                                                    	        <span class="input-group-btn">
	                                                    	            <button
                                                                                name="product_icons[icon][]"
                                                                                class="btn btn-block btn-info"
                                                                                data-iconset="fontawesome"
                                                                                data-icon="fa-facebook"
                                                                                role="iconpicker">
	                                                    	                </button>
	                                                            	</span>

                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-7  ">
                                                                        <div class="row entry input-group  social-icon-group">
                                                                            <input name="product_icons[text][]"
                                                                                   type="text"
                                                                                   placeholder="Diesel"
                                                                                   class="form-control"
                                                                                   value="">

                                                                            <span class="input-group-btn">

                                                                    <button class="btn btn-success btn-add"
                                                                            type="button">
                                                                          <span class="glyphicon glyphicon-plus"></span>
                                                                     </button>
                                                                      </span>

                                                                        </div>

                                                                    </div>
                                                                    <div class="clearfix"></div>

                                                                </div>
																<?php  } ?>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="resources">
                                                        <table id="resources-table"
                                                               class="table color-table purple-table">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__("Item name")}}</th>
                                                                <th>{{__("Quantity")}}</th>
                                                                <th>{{__('Cost ($)')}}</th>
                                                                <th>{{__("Duration")}}</th>
                                                                <th></th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @if(isset($product_meta['_rental_resource']) && $resources = json_decode($product_meta['_rental_resource']) )

                                                                @if(isset($resources->item_name))
                                                                    @foreach($resources->item_name as $j => $name)
                                                                        @include('plugin:eCommerce::products.tabs.resources', compact('j','name', 'resources') )
                                                                    @endforeach
                                                                @endif


                                                            @endif
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th colspan="6">

                                                                </th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                        <button data-tr='@include('plugin:eCommerce::products.tabs.resources',[
                                                        'j' => null,'name'  => null, 'resources'  => null

                                                        ])'
                                                                class="add-new-resources btn btn-info waves-effect waves-light">
                                                            <span><i class="ion-upload m-r-5"></i>{{__(" Add new Resources ")}}</span>

                                                        </button>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="season_price">


                                                        <table id="season-table"
                                                               class="table color-table">
                                                            <thead>
                                                            <tr>
                                                                <th>{{__("Base price")}}</th>
                                                                <th>{{__("Start season date")}}</th>
                                                                <th>{{__("End season date")}}</th>
                                                                <th>{{__("Discounts")}}</th>
                                                                <th></th>

                                                            </tr>
                                                            </thead>
                                                            <tbody class="tbody_season">

															<?php  $i = 0; ?>
                                                            @if($seasons ?? false)
                                                                @foreach($seasons as $season)
                                                                    @include('plugin:eCommerce::products.tabs.season', compact('season','i') )
																	<?php  $i ++; ?>
                                                                @endforeach
                                                            @else

                                                                {{--@include('plugin:eCommerce::products.tabs.season' )--}}
                                                            @endif
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <th colspan="6">

                                                                </th>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                        <button type="button" data-tr="{{$season_new_row ?? ''}}"
                                                                class="add-new-season btn btn-info waves-effect waves-light">
                                                            <span><i class="ion-upload m-r-5"></i>{{__(" Add new Season price ")}}</span>

                                                        </button>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane" id="settings">{{__("...")}}</div>
                                                    <div role="tabpanel" class="tab-pane" id="rental_location">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title" class="col-md-12">{{__('Picking Up Location')}}
                                                                    </label>
                                                                    <div class="col-md-12">
                                                                        <select name="__picking_up_location[]"
                                                                                class="select2 m-b-10 select2-multiple"
                                                                                multiple="multiple"
                                                                                data-placeholder="Choose">

																			<?php

																			$picking_up_location = json_decode( $product_meta['__picking_up_location'] ?? '' )
																			?>
                                                                            @if(isset($locations) && $locations)
                                                                                @foreach($locations as $location)
                                                                                    <option @if( is_array($picking_up_location) && in_array($location->alias, $picking_up_location )) selected
                                                                                            @endif value="{{$location->alias}}">{{$location->title}}</option>
                                                                                @endforeach
                                                                            @endif

                                                                        </select>

                                                                    </div>
                                                                    <label class="col-md-12">
                                                                        <input data-checkbox="icheckbox_square-red"
                                                                               type="checkbox"
                                                                               class="check  select_location_all"
                                                                               value="1">
                                                                       {{__(' Select all')}}</label>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title" class="col-md-12">{{__('Dropping Off Location')}}
                                                                    </label>
                                                                    <div class="col-md-12">
                                                                        <select name="__dropping_off_location[]"
                                                                                class="select2 m-b-10 select2-multiple"
                                                                                multiple="multiple"
                                                                                data-placeholder="Choose">

																			<?php
																			$dropping_off_location = json_decode( $product_meta['__dropping_off_location'] ?? '' )

																			?>
                                                                            @if(isset($locations) && $locations)
                                                                                @foreach($locations as $location)

                                                                                    <option
                                                                                            @if(is_array($dropping_off_location) &&  in_array($location->alias,  json_decode($product_meta['__dropping_off_location'] ?? '')) ) selected
                                                                                            @endif
                                                                                            value="{{$location->alias}}">{{$location->title}}</option>
                                                                                @endforeach
                                                                            @endif

                                                                        </select>
                                                                    </div>

                                                                    <label class="col-md-12">
                                                                        <input data-checkbox="icheckbox_square-red"
                                                                               type="checkbox"
                                                                               class="check select_location_all"
                                                                               value="1">
                                                                        {{__('Select all')}}</label>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">


                                                                <!--------------------------------- MAP ---------------------------->
                                                                <div class="map_container form-group">
                                                                    <div id="canvas2">
                                                                        <input id="pac-input"
                                                                               class="controls form-control" type="text"
                                                                               placeholder="Enter a location">

                                                                        <div id="type-selector"
                                                                             class="controls control-group">
                                                                            <label id='edited_Coordinatesaddplaces'>
                                                                               {{__(' Coordinates:')}} </label>
                                                                            <input
                                                                                    id="cordinats2"
                                                                                    type="text"
                                                                                    required name="rentit_lat_long"
                                                                                    class="form-control"
                                                                                    value="{{$product_meta['rentit_lat_long'] ?? ''}}"
                                                                            />

                                                                            <label id='edited_Addressaddplaces'>
                                                                                {{__('Formatted Address')}}</label>
                                                                            <input id="formatted_address"
                                                                                   data-geo="formatted_address"
                                                                                   name="rentit_formatted_address"
                                                                                   type="text"
                                                                                   value="{{$product_meta['rentit_formatted_address'] ?? ''}}"
                                                                                   class="form-control"

                                                                            >


                                                                            <input type="hidden" id="location_lon"
                                                                                   name="location_lon"
                                                                                   value="33.572681265624965">
                                                                            <input type="hidden" id="location_lat"
                                                                                   name="location_lat"
                                                                                   value="34.83385976867044">

                                                                        </div>
                                                                        <div id="map-canvas"></div>

                                                                        <script>
                                                                            var map;

                                                                            function initialize_map_new() {


                                                                                if (window.location.protocol != 'http:' && navigator.geolocation) {
                                                                                    navigator.geolocation.getCurrentPosition(function (position) {
                                                                                            var latitude = position.coords.latitude;
                                                                                            var longitude = position.coords.longitude;


                                                                                            var latlng = jQuery("#cordinats2").val();
                                                                                            if (latlng.length > 10) {
                                                                                                re = /\s*,\s*/;
                                                                                                arr = latlng.split(re);
                                                                                                var myLatLng = {
                                                                                                    lat: parseFloat(arr[0]),
                                                                                                    lng: parseFloat(arr[1])
                                                                                                };
                                                                                                latitude = parseFloat(arr[0]);
                                                                                                longitude = parseFloat(arr[1]);
                                                                                            }


                                                                                            var mapOptions = {
                                                                                                center: new google.maps.LatLng(latitude, longitude),
                                                                                                zoom: 13
                                                                                            };
                                                                                            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                                                                                            if (latlng.length > 10) {

                                                                                                var marker2 = new google.maps.Marker({
                                                                                                    position: myLatLng,
                                                                                                    map: map,
                                                                                                    title: 'Hello World!'
                                                                                                });
                                                                                            }
                                                                                            var input = (document.getElementById("pac-input"));
                                                                                            var types = document.getElementById("type-selector");
                                                                                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                                                                                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                                                                                            var autocomplete = new google.maps.places.Autocomplete(input);
                                                                                            autocomplete.bindTo("bounds", map);
                                                                                            var infowindow = new google.maps.InfoWindow();
                                                                                            var marker = new google.maps.Marker({
                                                                                                map: map,
                                                                                                draggable: true,
                                                                                                anchorPoint: new google.maps.Point(0, -29)
                                                                                            });

                                                                                            google.maps.event.addListener(autocomplete, "place_changed",
                                                                                                function () {
                                                                                                    infowindow.close();
                                                                                                    marker.setVisible(false);
                                                                                                    var place = autocomplete.getPlace();
                                                                                                    console.log(place);
                                                                                                    if (!place.geometry) {
                                                                                                        return;
                                                                                                    }


                                                                                                    if (place.geometry.viewport) {
                                                                                                        map.fitBounds(place.geometry.viewport);
                                                                                                    } else {
                                                                                                        map.setCenter(place.geometry.location);
                                                                                                        map.setZoom(17);
                                                                                                    }

                                                                                                    marker.setIcon(({
                                                                                                        url: place.icon,
                                                                                                        size: new google.maps.Size(71, 71),
                                                                                                        origin: new google.maps.Point(0, 0),
                                                                                                        anchor: new google.maps.Point(17, 34),
                                                                                                        scaledSize: new google.maps.Size(35, 35)
                                                                                                    }));
                                                                                                    marker.setPosition(place.geometry.location);
                                                                                                    marker.setVisible(true);

                                                                                                    jQuery("#location_lon").val(place.geometry.location.lng());
                                                                                                    jQuery("#location_lat").val(place.geometry.location.lat());

                                                                                                    var crtt = place.geometry.location.lat() + "," + place.geometry.location.lng();
                                                                                                    var foradre = place.formatted_address;
                                                                                                    jQuery("#cordinats2").val(crtt);
                                                                                                    jQuery("#cordinats2").trigger("change");
                                                                                                    jQuery("#formatted_address").val(foradre);

                                                                                                    var address = "";
                                                                                                    if (place.address_components) {
                                                                                                        address = [(place.address_components[0] && place.address_components[0].short_name || ""), (place.address_components[1] && place.address_components[1].short_name || ""), (place.address_components[2] && place.address_components[2].short_name || "")].join(" ");
                                                                                                    }
                                                                                                    infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);
                                                                                                    infowindow.open(map, marker);
                                                                                                }
                                                                                            );
                                                                                            /*************************/

                                                                                            google.maps.event.addListener(marker, "drag", function () {

                                                                                                /**
                                                                                                 * 1*/

                                                                                                jQuery.getJSON("https://maps.googleapis.com/maps/api/geocode/json?key={{get_theme_mod('google_api_key')}}&latlng=" + marker.getPosition().lat() + "," + marker.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {

                                                                                              console.log(data);
                                                                                                    var adress1 = data.results[0].formatted_address;
                                                                                                    infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                                                                                    jQuery("#formatted_address").val(adress1);
                                                                                                    jQuery("#location_lon").val(marker.getPosition().lng());
                                                                                                    jQuery("#location_lat").val(marker.getPosition().lat());

                                                                                                    jQuery("#cordinats2").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                                                                                                });
                                                                                                infowindow.open(map, marker);
                                                                                            });

                                                                                            function setupClickListener(id, types) {
                                                                                                var radioButton = document.getElementById(id);
                                                                                                google.maps.event.addDomListener(radioButton, "click", function () {
                                                                                                    autocomplete.setTypes(types);
                                                                                                });
                                                                                            }

                                                                                            setupClickListener("changetype-all", []);
                                                                                            setupClickListener("changetype-address", ["address"]);
                                                                                            setupClickListener("changetype-establishment", ["establishment"]);
                                                                                            setupClickListener("changetype-geocode", ["geocode"]);

                                                                                            /****************************/


                                                                                        }
                                                                                    )
                                                                                    ;

                                                                                }
                                                                                else {


                                                                                    var latitude = 34.800155;
                                                                                    var longitude = 33.030800;


                                                                                    var latlng = jQuery("#cordinats2").val();
                                                                                    if (latlng != undefined && latlng.length > 10) {
                                                                                        re = /\s*,\s*/;
                                                                                        arr = latlng.split(re);
                                                                                        var myLatLng = {
                                                                                            lat: parseFloat(arr[0]),
                                                                                            lng: parseFloat(arr[1])
                                                                                        };
                                                                                        latitude = parseFloat(arr[0]);
                                                                                        longitude = parseFloat(arr[1]);
                                                                                    }


                                                                                    var mapOptions = {
                                                                                        center: new google.maps.LatLng(latitude, longitude),
                                                                                        zoom: 13
                                                                                    };
                                                                                    map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                                                                                    if (latlng != undefined && latlng.length > 10) {

                                                                                        var marker2 = new google.maps.Marker({
                                                                                            position: myLatLng,
                                                                                            map: map,
                                                                                            draggable: true,
                                                                                            title: ''
                                                                                        });

                                                                                        google.maps.event.addListener(marker2, "drag", function () {
                                                                                            jQuery.getJSON("https://maps.googleapis.com/maps/api/geocode/json?key={{get_theme_mod('google_api_key')}}&&latlng=" + marker2.getPosition().lat() + "," + marker2.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                                                                                               console.log(data);

                                                                                                var adress1 = data.results[0].formatted_address;
                                                                                                infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                                                                                jQuery("#formatted_address").val(adress1);
                                                                                                jQuery("#location_lon").val(marker2.getPosition().lng());
                                                                                                jQuery("#location_lat").val(marker2.getPosition().lat());

                                                                                                jQuery("#cordinats2").val(marker2.getPosition().lat() + "," + marker2.getPosition().lng());

                                                                                            });
                                                                                            infowindow.open(map, marker);
                                                                                        });
                                                                                    }
                                                                                    var input = (document.getElementById("pac-input"));
                                                                                    var types = document.getElementById("type-selector");
                                                                                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                                                                                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
                                                                                    var autocomplete = new google.maps.places.Autocomplete(input);
                                                                                    autocomplete.bindTo("bounds", map);
                                                                                    var infowindow = new google.maps.InfoWindow();
                                                                                    var marker = new google.maps.Marker({
                                                                                        map: map,
                                                                                        draggable: true,
                                                                                        anchorPoint: new google.maps.Point(0, -29)
                                                                                    });


                                                                                    google.maps.event.addListener(autocomplete, "place_changed",
                                                                                        function () {

                                                                                            infowindow.close();
                                                                                            marker.setVisible(false);
                                                                                            var place = autocomplete.getPlace();
                                                                                            console.log(place);
                                                                                            if (!place.geometry) {
                                                                                                return;
                                                                                            }


                                                                                            if (place.geometry.viewport) {
                                                                                                map.fitBounds(place.geometry.viewport);
                                                                                            } else {
                                                                                                map.setCenter(place.geometry.location);
                                                                                                map.setZoom(17);
                                                                                            }

                                                                                            marker.setIcon(({
                                                                                                url: place.icon,
                                                                                                size: new google.maps.Size(71, 71),
                                                                                                origin: new google.maps.Point(0, 0),
                                                                                                anchor: new google.maps.Point(17, 34),
                                                                                                scaledSize: new google.maps.Size(35, 35)
                                                                                            }));
                                                                                            marker.setPosition(place.geometry.location);
                                                                                            marker.setVisible(true);

                                                                                            jQuery("#location_lon").val(place.geometry.location.lng());
                                                                                            jQuery("#location_lat").val(place.geometry.location.lat());

                                                                                            var crtt = place.geometry.location.lat() + "," + place.geometry.location.lng();
                                                                                            var foradre = place.formatted_address;
                                                                                            jQuery("#cordinats2").val(crtt);
                                                                                            jQuery("#cordinats2").trigger("change");
                                                                                            jQuery("#formatted_address").val(foradre);

                                                                                            var address = "";
                                                                                            if (place.address_components) {
                                                                                                address = [(place.address_components[0] && place.address_components[0].short_name || ""), (place.address_components[1] && place.address_components[1].short_name || ""), (place.address_components[2] && place.address_components[2].short_name || "")].join(" ");
                                                                                            }
                                                                                            infowindow.setContent("<div><strong>" + place.name + "</strong><br>" + address);
                                                                                            infowindow.open(map, marker);
                                                                                        }
                                                                                    );
                                                                                    /*************************/

                                                                                    google.maps.event.addListener(marker, "drag", function () {
                                                                                        jQuery.getJSON("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCwVuYiM-83l2IdjpT9uC0lg4jBm8-w4j8&latlng=" + marker.getPosition().lat() + "," + marker.getPosition().lng() + "&sensor=true_or_false", function (data, textStatus) {
                                                                                            var adress1 = data.results[0].formatted_address;
                                                                                            infowindow.setContent("<div><strong>" + adress1 + "</strong><br>" + data.results[1].formatted_address);
                                                                                            jQuery("#formatted_address").val(adress1);
                                                                                            jQuery("#location_lon").val(marker.getPosition().lng());
                                                                                            jQuery("#location_lat").val(marker.getPosition().lat());

                                                                                            jQuery("#cordinats2").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                                                                                        });
                                                                                        infowindow.open(map, marker);
                                                                                    });


                                                                                    function setupClickListener(id, types) {
                                                                                        var radioButton = document.getElementById(id);
                                                                                        google.maps.event.addDomListener(radioButton, "click", function () {
                                                                                            autocomplete.setTypes(types);
                                                                                        });
                                                                                    }

                                                                                    //setupClickListener("changetype-all", []);
                                                                                    /* setupClickListener("changetype-address", ["address"]);
                                                                                     setupClickListener("changetype-establishment", ["establishment"]);
                                                                                     setupClickListener("changetype-geocode", ["geocode"]);*/

                                                                                    /****************************/


                                                                                }


                                                                            }

                                                                            function initialize_map() {
                                                                                var triger = false;

                                                                                jQuery("a[href='#rental_location']").click(function () {
                                                                                    if (triger == false) {
                                                                                        console.log(1);
                                                                                        initialize_map_new();
                                                                                        triger = true;
                                                                                    }

                                                                                });

                                                                            }
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="form-actions m-t-40">
                                                <button id="publish" type="submit" class="btn btn-success btn-lg"><i
                                                            class="fa fa-check"></i>
                                                    {{__('Save')}}
                                                </button>
                                                <button onclick="location.reload();" type="button"
                                                        class="btn btn-default btn-lg pull-right">{{__('Cancel')}}
                                                </button>
                                            </div>
                                            <br>


                                            <div class="form-group   ">
                                                <h3 class="box-title control-label">
                                                    <strong>  {{__('admin.Category')}}</strong></h3>


                                                <div class="cat-group">
                                                    {!!  $category_list ?? '' !!}
                                                </div>
                                                <br>

                                            </div>


                                            <div class="form-group   ">
                                                <h3 class="box-title control-label">
                                                    <strong>  {{__('admin.Category group')}}</strong></h3>


                                                <div class="cat-group">
                                                    {!!  $group_list  ?? ''!!}
                                                </div>
                                                <br>

                                            </div>

                                            <div class="form-group">
                                                <h3 class="box-title control-label">{{__('admin.Status')}}</h3>
                                                <div class="radio-list">
                                                    <label class="radio-inline p-0">

                                                        <div class="radio radio-info">
                                                            <input <?php  if ( isset( $product ) )
																checked( $product->status, 'published' ) ?> type="radio"
                                                                   name="status" id="radio1" value="published">
                                                            <label for="radio1">{{__('admin.Published')}}</label>
                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input <?php   if ( isset( $product ) )
																checked( $product->status, 'draft' ) ?> type="radio"
                                                                   name="status" id="radio2" value="draft">
                                                            <label for="radio2">{{__('admin.Draft')}}</label>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->

                                        <div class="form-group">
                                            <h3 class="box-title">{{__('admin.Featured Image')}}</h3>
                                            <div class="product-img">
                                                @if(isset($product->img))
                                                    <img class="img-responsive"
                                                         src="{{ the_image_url($product->img,'thumbnail-260x260') }}">
                                                    <input type="hidden" name="img" value="{{$product->img}}"
                                                           class="featured_image_id">
                                                @else
                                                    <img class="img-responsive"
                                                         src="{{ the_image_url(old('img',  asset(config('settings.admin')) .'/plugins/images/placeholder.png')) }} ">
                                                    <input type="hidden" name="img" value="{{  old('img')  }}"
                                                           class="featured_image_id">
                                                @endif


                                                <br>
                                                <br>
                                                <div class="set_media fileupload btn btn-info waves-effect waves-light">
                                                    <span><i class="ion-upload m-r-5"></i> {{__('admin.Set featured Image')}} </span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="box-title">{{__('admin.Product gallery images')}}</h3>


                                            <div class="product-gallery-images">


                                                @if( isset($product_meta['gallery_media'])  )

													<?php  $gallery = explode( ',', $product_meta['gallery_media'] ); ?>
                                                    @foreach($gallery as $item)
                                                        <div data-id='{{$item}}' class="product-img   gallery-image">
                                                            <a href="javascript:void(0)" class="text-danger delete"
                                                               title=""
                                                               data-id="3" data-toggle="tooltip"
                                                               data-original-title="Delete">
                                                                <i class="fa fa-times-circle"></i></a>
                                                            <img class="img-responsive"
                                                                 src="{{ the_image_url($item,'thumbnail-70x70') }}">
                                                        </div>

                                                    @endforeach


                                                @endif

                                            </div>
                                            <input type="hidden"
                                                   value="{{ isset($product_meta['gallery_media']) ? $product_meta['gallery_media'] : ''  }}"
                                                   id="gallery-media" name="gallery_media">
                                            <div class="product-img">
                                                <br>
                                                <br>
                                                <div class="clearfix"></div>
                                                <div class="set_media_gallery  btn btn-info waves-effect waves-light  ">

                                                    <span><i class="ion-upload m-r-5"></i> {{__('admin.Set gallery images')}} </span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h3 class="box-title">{{__('Product stars')}}</h3>

                                            <select class="form-control" name="product_stars">
                                                <option
													<?php  selected( 1, $product_meta['product_stars'] ?? 5 ) ?> value="1">
                                                    1
                                                </option>
                                                <option
													<?php  selected( 2, $product_meta['product_stars'] ?? 5 ) ?> value="2">
                                                    2
                                                </option>
                                                <option
													<?php  selected( 3, $product_meta['product_stars'] ?? 5 ) ?> value="3">
                                                    3
                                                </option>
                                                <option
													<?php  selected( 4, $product_meta['product_stars'] ?? 5 ) ?> value="4">
                                                    4
                                                </option>
                                                <option
													<?php  selected( 5, $product_meta['product_stars'] ?? 5 ) ?> value="5">
                                                    5
                                                </option>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                                <hr>
                            </div>


                            <div class="form-actions m-t-40">
                                <button id="publish" type="submit" class="btn btn-success  btn-lg "><i
                                            class="fa fa-check"></i>
                                    Save
                                </button>
                                <button onclick="location.reload();" type="button" class="btn btn-default  btn-lg">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type='text/javascript'
        src='https://maps.googleapis.com/maps/api/js?key={{ get_theme_mod( 'google_api_key' ) }}&libraries=places&callback=initialize_map&ver=4.9.8'></script>
<script>


    // $(document).ready(function () {

    var medialibrary_obj = {
        'ajaxUrl': '{{route('media_media_popup')}}'
//			'store' => route('admin.media.store')
    };

    function init_date_pikers() {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

        jQuery('.PickingUpDate').datetimepicker({
            minDate: today,
            format: '{{get_theme_mod( 'rentit_calendar_format', 'MM/DD/YYYY' )}}',
            locale: '{{get_theme_mod( 'rentit_calendar_lang', '' )}}',


        });
        jQuery('.DroppingOffDate').datetimepicker({
            minDate: today,
            format: '{{get_theme_mod( 'rentit_calendar_format', 'MM/DD/YYYY' )}}',
            locale: '{{get_theme_mod( 'rentit_calendar_lang', '' )}}',


        });


        jQuery(".PickingUpDate").on("dp.change", function (e) {

            var calendar = $(this).closest('tr').find('.DroppingOffDate');
            calendar.data("DateTimePicker").minDate(e.date);
            calendar.val(moment(e.date).format('{{get_theme_mod( 'rentit_calendar_format', 'MM/DD/YYYY' )}}'));
        });


    }


    function updateSeasonId() {
        $('.tbody_season_tr').each(function (index) {
            console.log(index);


            $(this).find('.t_season_discounts').each(function (i) {
                // $(this).find('.duration_val').hide();
                var cost = $(this).find('.input_text.cost').attr('name');
                //  $(this).find('.input_text.cost').val('222');
                var duration_val = $(this).find('.duration_val').attr('name');
                var duration_type = $(this).find('.duration_type').attr('name');
                if (typeof cost !== 'undefined' && cost) {
                    //   console.log(cost.replace('/\[\\d\]/', '200'));
                }

                if (typeof cost !== 'undefined' && cost)
                    $(this).find('.input_text.cost').attr('name', cost.replace(/\d+/, index));

                if (typeof duration_val !== 'undefined' && duration_val)
                    $(this).find('.duration_val').attr('name', duration_val.replace(/\d+/, index));
                if (typeof duration_type !== 'undefined' && duration_type)
                    $(this).find('.duration_type.cost').attr('name', duration_type.replace(/\d+/, index));

            });

        });
    }

    jQuery(document).ready(function ($) {


        /*
        *
        * Add Seasons
        * */


        init_date_pikers();

        $("body").on("click", ".add-new-season", function (e) {
            $('#season-table .tbody_season').append($(this).data('tr'));
            updateSeasonId();
            init_date_pikers();


        });
        $("body").on("click", ".insert_season_discounts", function (e) {
            //   e.preventDefault();
            // $(this).closest('table').find('.season_discount').append($(this).data('row'));
            $(this).closest('.t_season_discounts').find('tbody').append($(this).data('row'));


            updateSeasonId();


        });

        $("body").on("click", ".tbody_season .btn-delete", function (e) {
            setTimeout(function () {

                updateSeasonId();
                console.log('ok');
            }, 500);

        });


        /*
        End add sesaons
         */


        /*
         *
         *Add icons
         *
         */

        var button_add_img;


        $("body").on("click", ".social-button-items .btn-add", function () {

            var formRow = $(this).closest('.social-button-items');
            var clone = formRow.clone();
            clone = clone.html()
                .replace('btn-success', 'btn-danger')
                .replace('btn-add', 'btn-delete')
                .replace('glyphicon-plus', 'glyphicon-minus');

            clone = '<div class="social-button-items ">' + clone + '</div>';
            $(this).closest('.social-button-items-all').append(clone);
            //  $('.social-button-items-all').append(clone);
            $('.iconpicker').iconpicker();
        });


        $("body").on("click", ".social-button-items .btn-delete", function () {
            console.log(0);
            $(this).closest('.social-button-items').remove();
        });


        $('.add-new-item').click(function (e) {
            e.preventDefault();
            console.log($(this).data('tr'));
            console.log($(this).closest('div'));
            $(this).closest('div').find('tbody').append($(this).data('tr'));
        });


        $("body").on("click", ".btn-delete", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });


        /*
        End add icons
        */


        jQuery(document).on("click", '#publish', function (e) {
            //alert()
            if (jQuery('#cordinats2').val() == "") {
                jQuery('#product-type').val('rentit_rental').trigger('click');
                jQuery('#product-type').trigger('change');
                jQuery('a[href="#rental_location"]').click();
                alert('Please fill coordinates')

                setTimeout(function () {
                    jQuery("#pac-input").focus();
                }, 500);


            }
        });


        /*
        multi select

        */

        $(".select2").select2();

        $('input.select_location_all').on('ifChecked', function (event) {
            $(this).closest('.form-group').find('select').select2('destroy').find('option').prop('selected', 'selected').end().select2()

        });
        /*
         upload image
         */

        $('.set_media').click(function (e) {
            mediaLibrary.open();
            mediaLibrary.event = 'product-img';
            var button = $(this);
            $('#mediaLibrary-modal').on('mediaLibrary.product-img', function (e, img_id, img_src) {
                var img_f = button.closest('.product-img');
                img_f.find('img').attr('src', img_src);
                img_f.find('input').val(img_id);

            });
        });


        $('.set_media_gallery').click(function (e) {
            mediaLibrary.open();
            mediaLibrary.event = 'product-gallery-img';

        });
        var product_gallery = [];
        if ($('#gallery-media').val().length > 0) {
            product_gallery = $('#gallery-media').val().split(',');
        }
        $('#mediaLibrary-modal').on('mediaLibrary.product-gallery-img', function (e, img_id, img_src) {


            if ($('.gallery-image img[src="' + img_src + '"]').length === 0) {
                $('.product-gallery-images').append("<div data-id='" + img_id + "' class=\"product-img   gallery-image\">\n" +
                    "                                                    <a href=\"javascript:void(0)\" class=\"text-danger delete\" title=\"\" data-id=\"3\" data-toggle=\"tooltip\" data-original-title=\"Delete\">\n" +
                    "                                                        <i class=\"fa fa-times-circle\"></i></a>\n" +
                    "                                                    <img class=\"img-responsive\" src=\"" + img_src + "\">\n" +
                    "                                                </div>");

            }

            product_gallery.push(img_id);
            $('#gallery-media').val(product_gallery.join(','));

        });


        $("body").on("click", ".gallery-image .delete", function (e) {
            e.preventDefault();

            id = $(this).data('id');
            var idx = product_gallery.findIndex(function (p) {
                return p === id;
            });
            product_gallery.splice(idx, 1);
            $('#gallery-media').val(product_gallery.join(','));

            $(this).closest('.product-img').fadeOut(500).remove();


        });

        /// rsources


        $('.add-new-attributes').click(function (e) {
            e.preventDefault();
            $('.resources-table').append($(this).data('tr'));
        });
        $('.add-new-resources').click(function (e) {
            e.preventDefault();
            $('#resources-table').append($(this).data('tr'));
        });

        $("body").on("click", ".resources-table  .btn-delete", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
        $("body").on("click", "#resources-table .btn-delete", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });


    });


    tinymce.init({
        selector: 'textarea.text',
        height: 300,
        //    theme: 'modern',
        plugins: 'paste print preview   searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        images_upload_url: 'postAcceptor.php',
        /*   menubar: "edit",'*/
        toolbar: "paste",
        paste_data_images: true,
        images_upload_handler: function (blobInfo, success, failure) {
            var formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.blob().name);
            formData.append('tiny_uploader', '1');

            $.ajax({
                url: '{{route('admin.media.store')}}',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    success(obj.location);
                    console.log(obj.location);

                }
            });
        },


    });


</script>
