<!-- CONTENT AREA -->
<div class="content-area scroll">

    <div class="open-close-area" id="open-close-area"><a href="#"><i class="fa fa-angle-left"></i></a></div>

    <div class="helping-center-line">
        <div class="container">
            <h4>{{__("Helping Center")}}</h4>
            <span>{{__('+90 555 444 66 33')}}</span>
            <a href="#" class="btn btn-theme btn-theme-dark">{{__(" Write Ticket")}}</a>
        </div>
    </div>

    <div class="swiper-wrapper">
        <div class="swiper-slide">

            <!-- PAGE -->
            <section class="page-section">
                <div class="container">

                    <hr class="page-divider small transparent"/>
                    <h3 class="block-title alt2"><i class="fa fa-angle-down"></i>{{__("Find Best Rental Car")}}</h3>

                    <!-- Search form -->
                    <div class="form-search light">
                        <form action="#">

                            <div class="row row-inputs">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchUpLocation">{{__('Picking Up Location')}}</label>
                                        <select name="PickingUpLocation"
                                                class="selectpicker input-price"
                                                data-live-search="true"
                                                data-width="100%"
                                                data-toggle="tooltip"
                                                id="formSearchUpLocation"
                                        >
                                            @if($locations ?? false)
                                                @foreach($locations as $location)


                                                    <option
					                                    <?php  selected(( $request->PickingUpLocation ?? session( 'PickingUpLocation' ) ), $location->alias ); ?>
                                                        value="{{$location->alias}}">{{$location->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchOffLocation">{{__('Dropping Off Location')}}</label>
                                        <select id="formSearchOffLocation"
                                                name="DroppingOffLocation"
                                                class="selectpicker input-price"
                                                data-live-search="true"
                                                data-width="100%"
                                                data-toggle="tooltip" title="Select">
                                            @if($locations)
                                                @foreach($locations as $location)

                                                    <option
					                                    <?php  selected( (  $request->DroppingOffLocation ??  session( 'DroppingOffLocation' ) ), $location->alias ); ?>
                                                        value="{{$location->alias}}">{{$location->title}}</option>

                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-inputs">
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchUpDate">{{__('Picking Up Date')}}</label>
                                        <input autocomplete="off"
                                               name="PickingUpDate"
                                               type="text"
                                               class="PickingUpDate form-control datepicker"
                                               id="formSearchUpDate"
                                               placeholder="dd/mm/yyyy"
                                               value="{{$request->PickingUpDate ?? session('PickingUpDate')}}"
                                        >
                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group has-icon has-label">
                                        <label>{{__('Picking Up Hour')}}</label>

                                        <select
                                                name="PickingUpHour"
                                                class="selectpicker input-price"
                                                data-live-search="true"
                                                data-width="100%"
                                                data-toggle="tooltip" title="Select">

		                                    <?php  $times = rentit_get_times(); ?>
                                            @if($times && is_array($times))
                                                @foreach($times as $time)
                                                    <option
					                                    <?php  selected( (  $request->PickingUpHour ??   session( 'PickingUpHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchOffDate2">{{__("Dropping Off Date")}}</label>
                                        <input autocomplete="off"
                                               name="DroppingOffDate"
                                               type="text"
                                               class="form-control datepicker DroppingOffDate"
                                               id="formSearchOffDate2"
                                               placeholder="dd/mm/yyyy"
                                               value="{{$request->DroppingOffDate ?? session('DroppingOffDate')}}"
                                        >
                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group has-icon has-label">
                                        <label>{{__("Dropping Off Hour")}}</label>
                                        <select name="DroppingOffHour"
                                                class="selectpicker input-price"
                                                data-live-search="true" data-width="100%"
                                                data-toggle="tooltip" title="Select">
                                            @if($times && is_array($times))
                                                @foreach($times as $time)
                                                    <option
					                                    <?php  selected( ($request->DroppingOffHour ?? session( 'DroppingOffHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-submit">
                                <div class="container-fluid">
                                    <div class="inner">
                                        <i class="fa fa-plus-circle"></i>
                                        <button type="submit" id="formSearchSubmit2"
                                                class="btn btn-submit btn-theme pull-right">{{__('Find Car')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search form -->

                    <hr class="page-divider half transparent"/>

                    <h3 class="block-title alt2"><i class="fa fa-angle-down"></i>{{__("Result Rental Car")}}</h3>

                    <div class="row">
                        @if($products && $products->total() > 0)
                            @foreach($products as $product)
								<?php        $product_meta = getProductMetas( $product );?>

                                <div class="col-md-6">
                                    <div class="thumbnail no-border no-padding thumbnail-car-card">
                                        <div class="media">
                                            @if(isset($product->img) && $product->img > 0)
                                                <a class="media-link" href="{{ the_image_url($product->img) }}" data-gal="prettyPhoto">
                                                    <img src="{{ the_image_url($product->img,'thumbnail-370x220') }}">
                                                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                                                </a>

                                            @endif
                                        </div>
                                        <div class="caption text-center">
                                            <h4 class="caption-title"><a href="{{route('products.show',['products'=> $product->alias ])}}">{{$product->title}}</a></h4>
                                            <div class="caption-text">{{__('Start from')}} {{ formatted_price($product->price)  }}{{__('/per a day')}}</div>
                                            <div class="buttons">

                                                <a class="btn btn-theme btn-theme-dark"
                                                   href="{{route('products.show',['products'=> $product->alias ])}}">
                                                    {{get_theme_mod('rentit_rent_it',__('Rent It'))}}

                                                </a>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
			                                            <?php
			                                            if($product_meta['product_icons'] ?? false) {
			                                            $product_icons = unserialize( $product_meta['product_icons'] );


			                                            if ( is_array( $product_icons ) && $product_icons['icon'] ?? false && $product_icons['text'] ?? false) {
			                                            $product_icons = array_combine( $product_icons['icon'], $product_icons['text'] );


			                                            $j = 0;
			                                            foreach ( $product_icons as $k => $text ) {  ?>
                                                        <td><i class="fa {{$k}}"></i> {{$text}}</td>
			                                            <?php
			                                            }
			                                            }
			                                            }
			                                            ?>


                                                    </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        @endif






                    </div>
                    <!-- /Blog posts -->
                @if($products->lastPage() > 1)
                    <!-- Pagination -->
                    <div class="clearfix"></div>
                        <div class="pagination-wrapper">
                            <ul class="pagination">
                                @if($products->currentPage() !== 1)
                                    <li class="disabled"><a href="{{$products->url(($products->currentPage() - 1))}}">
                                            <i class="fa fa-angle-double-left"></i>{{__('Previous')}} </a></li>

                                @endif

                                @for($i = 1; $i <= $products->lastPage(); $i++)
                                    @if($products->currentPage() == $i)

                                        <li class="active"><a href="#">{{ $i }}
                                                <span class="sr-only"></span></a>
                                        </li>
                                    @else

                                        <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if($products->currentPage() !== $products->lastPage())

                                    <li><a href="{{ $products->url(($products->currentPage() + 1)) }}">{{__('Next')}} <i
                                                    class="fa fa-angle-double-right"></i></a></li>
                                @endif

                            </ul>
                        </div><br><br>
                        <!-- /Pagination -->
                    @endif

                </div>
            </section>
            <!-- /PAGE -->

        </div>
    </div>
    <!-- Add Scroll Bar -->
    <div class="swiper-scrollbar"></div>

</div>
<!-- /CONTENT AREA -->


<script type="text/javascript">
    var
        mapObject,
        markers = [],
        markersData =  {!! $markersData  !!}


    }
    ;


    function initialize_map() {
        loadScript("{{url('/')}}/rentit/assets/js/infobox.js", after_load);
    }

    function after_load() {
        var global_scrollwheel = false;
        var markerClusterer = null;
        var markerCLuster;
        var Clusterer;

        initialize_new2();
    }

    function loadScript(src, callback) {
        var s,
            r,
            t;
        r = false;
        s = document.createElement('script');
        s.type = 'text/javascript';
        s.src = src;
        s.onload = s.onreadystatechange = function () {
            ////console.log( this.readyState ); //uncomment this line to see which ready states are called.
            if (!r && (!this.readyState || this.readyState == 'complete')) {
                r = true;
                callback();
            }
        };
        t = document.getElementsByTagName('script')[0];
        t.parentNode.insertBefore(s, t);

    }
</script>
