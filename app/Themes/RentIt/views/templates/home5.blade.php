<section class="page-section no-padding no-bottom-space-off">
    <div class="container full-width gmap-background">

        <div class="container">
            <div class="on-gmap">
                <!-- Search form -->
                <div class="form-search light">
                    <form action="{{ route('products.index') }}" method="get">
                        <div class="form-title">
                            <i class="fa fa-globe"></i>
                            <h2>{{__("Search for Cheap Rental Cars Wherever Your Are")}}</h2>
                        </div>

                        <div class="row row-inputs">
                            <div class="container-fluid">
                                <div class="col-sm-12">
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
						                                <?php  selected( old( 'PickingUpLocation', session( 'PickingUpLocation' ) ), $location->alias ); ?>
                                                        value="{{$location->alias}}">{{$location->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-control-icon"><i
                                                    class="fa fa-map-marker"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
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
					                                    <?php  selected( old( 'DroppingOffLocation', session( 'DroppingOffLocation' ) ), $location->alias ); ?>
                                                        value="{{$location->alias}}">{{$location->title}}</option>

                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-control-icon"><i
                                                    class="fa fa-map-marker"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-inputs">
                            <div class="container-fluid">
                                <div class="col-sm-7">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchUpDate">{{__('Picking Up Date')}}</label>
                                        <input autocomplete="off"
                                               name="PickingUpDate"
                                               type="text"
                                               class="PickingUpDate form-control datepicker"
                                               id="formSearchUpDate"
                                               placeholder="dd/mm/yyyy"
                                               value="{{session('PickingUpDate')}}"
                                        >
                                        <span class="form-control-icon"><i
                                                    class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
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
					                                    <?php  selected( old( 'PickingUpHour', session( 'PickingUpHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-inputs">
                            <div class="container-fluid">
                                <div class="col-sm-7">
                                    <div class="form-group has-icon has-label">
                                        <label for="formSearchOffDate">{{__('Dropping Off Date')}}</label>
                                        <input autocomplete="off"
                                               name="DroppingOffDate"
                                               type="text"
                                               class="form-control datepicker DroppingOffDate"
                                               id="formSearchOffDate"
                                               placeholder="dd/mm/yyyy"
                                               value="{{session('DroppingOffDate')}}"
                                        >
                                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group has-icon has-label">
                                        <label>{{__("Dropping Off Hour")}}</label>
                                        <select name="DroppingOffHour"
                                                class="selectpicker input-price"
                                                data-live-search="true"
                                                data-width="100%"
                                                data-toggle="tooltip" title="Select">
                                            @if($times && is_array($times))
                                                @foreach($times as $time)
                                                    <option
					                                    <?php  selected( old( 'DroppingOffHour', session( 'DroppingOffHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row row-submit">
                            <div class="container-fluid">
                                <div class="inner">
                                    <i class="fa fa-plus-circle"></i>
                                    <button type="submit" id="formSearchSubmit2" class="btn btn-submit btn-theme pull-right">{{__("Find Car")}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Search form -->
            </div>
        </div>

        <!-- Google map -->
        <div class="google-map">
            <div id="map-canvas"></div>
        </div>
        <!-- /Google map -->

    </div>
    <script type="text/javascript">
        var
            mapObject,
            markers = [],
            markersData =  {!! $markersData  !!}


        }
        ;


        function initialize_map() {


            loadScript("/rentit/js/infobox.js", after_load);

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
    <!-- /PAGE -->
</section>

<!-- PAGE -->
<section class="page-section testimonials alt">
    <div class="container">
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials-alt">
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object testimonial-avatar" src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                </a>
                            </div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object testimonial-avatar" src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                </a>
                            </div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object testimonial-avatar" src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                </a>
                            </div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object testimonial-avatar" src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="Testimonial avatar">
                                </a>
                            </div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <small>{{__("Select What You Want")}}</small>
            <span>{{__("Our awesome Rental Fleet cars")}}</span>
        </h2>

        @if($terms)



            <div class="tabs awesome wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <ul id="tabs1" class="nav"><!--

                <?php  $i = 1; ?>
                        -->
                    @foreach($terms as $item)

                        @if($item->type == 'group')
                            <li data-q="{{$i}}" class="{{($i == 2 ? 'active' : '')}}"><a href="#tab-x{{$i}}"
                                                                                         data-toggle="tab">{{$item->title}}</a></li>

							<?php  $i ++; ?>
                        @endif
                    @endforeach


                </ul>
            </div>



            <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
                <!-- tab 1 -->

				<?php  $i = 1; ?>

                @foreach($terms as $item)
                    @if($item->type == 'group')
                        <div class="mutabsss tab-pane fade panel1 {{ ( $i == 1 ) ? ' active in ' : ''}}"
                             id="tab-x{{$i}}">
                            <div class="car-big-card">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="tabs awesome-sub">
                                            <ul id="tabs4" class="nav"><!--

                                            -->
												<?php  $j = 1; ?>
                                                @foreach($item->products as $product)
                                                    <li class="{{( $j == 1 ) ? ' active' : ""}} linkswiperSlider{{$i}}x{{$j}}">
                                                        <a
                                                                href="#tab-x{{$i}}x{{$j}}"
                                                                data-swiper="swiperSlider{{$i}}x{{$j}}"
                                                                data-toggle="tab">{{$product->title}}</a></li><!--
                                            -->
													<?php  $j ++; ?>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">

                                        <!-- Sub tabs content -->
                                        <div class="tab-content">

                                            <div class="tab-content">
												<?php  $j = 1; ?>
                                                @foreach($item->products as $product)
                                                    <div class="tab-pane mytab_car fade custumclass {{( $j == 1 ) ? ' active in' : ""}}"
                                                         id="tab-x{{$i}}x{{$j}}">
                                                        <div class="row">
                                                            <div class="col-md-8">
															<?php
															$gallery_media = [];
															foreach ( $product->meta as $meta ) {
																if ( $meta->name == 'gallery_media' ) {
																	$gallery_media = explode( ',', $meta->value );
																}
															}

															?>
                                                            <!-- Swiper -->
                                                                <div class="swiper-container"
                                                                     id="swiperSlider{{$i}}x{{$j}}"
                                                                     data-img0="{{the_image_url($product->img,'thumbnail-600x426')}}"
                                                                     @if($gallery_media && isset($gallery_media[0]{0}))

                                                                     @foreach($gallery_media as $k => $gItme)
                                                                     data-img{{$k+1}}="{{the_image_url($gItme,'thumbnail-600x426')}}"
                                                                        @endforeach
                                                                        @endif
                                                                >
                                                                    <div class="swiper-wrapper">
                                                                        <div class="swiper-slide">
                                                                            <a class="btn btn-zoom"
                                                                               href="{{the_image_url($product->img)}}"
                                                                               data-gal="prettyPhoto"><i
                                                                                        class="fa fa-arrows-h"></i></a>
                                                                            <a href="{{the_image_url($product->img)}}"
                                                                               data-gal="prettyPhoto"><img
                                                                                        class="img-responsive"
                                                                                        src="{{the_image_url($product->img,'thumbnail-600x426')}}"
                                                                                        alt=""/></a>
                                                                        </div>


                                                                        @if($gallery_media && isset($gallery_media[0]{0}))

                                                                            @foreach($gallery_media as $gItme)
                                                                                <div class="swiper-slide">
                                                                                    <a class="btn btn-zoom"
                                                                                       href="{{the_image_url($gItme)}}"
                                                                                       data-gal="prettyPhoto"><i
                                                                                                class="fa fa-arrows-h"></i></a>
                                                                                    <a href="{{the_image_url($gItme)}}"
                                                                                       data-gal="prettyPhoto"><img
                                                                                                class="img-responsive"
                                                                                                src="{{the_image_url($gItme, 'thumbnail-600x426')}}"
                                                                                                alt=""/></a>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif


                                                                    </div>
                                                                    <!-- Add Pagination -->
                                                                    <div class="row car-thumbnails"></div>
                                                                </div>
                                                            </div>
                                                            <script>

                                                                jQuery(document).ready(function ($) {

                                                                    var wiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>;

                                                                    swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?> = new Swiper(swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>, {

                                                                        pagination: '#swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?> .row.car-thumbnails',

                                                                        paginationClickable: true,
                                                                        initialSlide: 0, //slide number which you want to show-- 0 by default
                                                                        paginationBulletRender: function (index, className) {

                                                                            var img = jQuery('#swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>').data("img" + index);

                                                                            return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '">' +

                                                                                '<a href="#"><img width="70" height="70" class="responsive" src="' + img + ' "' +

                                                                                ' alt=""/></a></div>';


                                                                        }

                                                                    });

                                                                    setTimeout(function () {
                                                                        swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.update();
                                                                        swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.onResize();
                                                                        swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.slideTo(0);
                                                                    }, 500);

                                                                    jQuery('.linkswiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>').click(function () {
                                                                        console.log('.linkswiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>');
                                                                        setTimeout(function () {
                                                                            swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.update();
                                                                            swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.onResize();
                                                                            swiperSlider<?php echo (int) $i; ?>x<?php echo (int) $j; ?>.slideTo(0)
                                                                        }, 250);
                                                                    });


                                                                });

                                                            </script>
                                                            <div class="col-md-4">
                                                                <div class="car-details">
                                                                    <div class="price">
                                                                        <strong>{{$product->price}}</strong>{{__(" ")}}
                                                                        <span>{{__("$/per a day ")}}</span><i
                                                                                class="fa fa-info-circle"></i>
                                                                    </div>
                                                                    <div class="list">
                                                                        <ul>
																			<?php  $product_meta = getProductMetas( $product ); ?>
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
                                                                    <div class="button">
                                                                        <a href="{{route('products.show',['products'=> $product->alias ])}}"
                                                                           class="btn btn-theme ripple-effect btn-theme-dark btn-block">{{__("Reservation Now")}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

													<?php  $j ++; ?>
                                                @endforeach

                                            </div>

                                        </div>
                                        <!-- /Sub tabs content -->

                                    </div>
                                </div>
                            </div>
                        </div>
						<?php  $i ++; ?>
                    @endif
                @endforeach

            </div>
        @endif
    </div>

    <script>

        jQuery(document).ready(function ($) {


            jQuery('#tabs1 li a').eq(0).click();


            jQuery('.tab-content .panel1.mutabsss').removeClass('active');

            jQuery('.tab-content .panel1.mutabsss').eq(0).find('.mytab_car').removeClass('active');


            jQuery('.tab-content .panel1').eq(0).addClass('active in');

            jQuery('.tab-content .panel1').eq(0).find('.tabs a').eq(0).click();
            jQuery('.tab-content .panel1').eq(0).find('.mytab_car').eq(0).addClass('active in');

            jQuery('#tabs1 li').click(function (e) {
                var id = $(this).data('q');

                console.log(id);
                setTimeout(function () {
                    console.log('swiperSlider' + id + 'x1.update()');
                    eval('swiperSlider' + id + 'x1.update()');
                    eval('swiperSlider' + id + 'x1.onResize()');

                }, 250);
                $('#swiperSlider2x1').update();
            });
        });

    </script>
</section>
<!-- /PAGE -->







<!-- PAGE -->
<section class="page-section contact dark">
    <div class="container">

        <!-- Get in touch -->

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>{{__('Feel Free to Say Hello!')}}</small>
            <span>{{__("Get in Touch With Us")}}</span>
        </h2>

        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <!-- Contact form -->
                <form name="contact-form" method="post" action="#" class="contact-form" id="contact-form">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="name">{{__("Name")}}</label>
                                    <input
                                            type="text" name="name" id="name" placeholder="Name" value="" size="30"
                                            data-toggle="tooltip" title="Name is required"
                                            class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="outer required">
                                <div class="form-group af-inner has-icon">
                                    <label class="sr-only" for="email">{{__("Email")}}</label>
                                    <input
                                            type="text" name="email" id="email" placeholder="Email" value="" size="30"
                                            data-toggle="tooltip" title="Email is required"
                                            class="form-control placeholder"/>
                                    <span class="form-control-icon"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="outer required">
                        <div class="form-group af-inner has-icon">
                            <label class="sr-only" for="subject">{{__("Subject")}}</label>
                            <input
                                    type="text" name="subject" id="subject" placeholder="Subject" value="" size="30"
                                    data-toggle="tooltip" title="Subject is required"
                                    class="form-control placeholder"/>
                            <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                        </div>
                    </div>

                    <div class="form-group af-inner has-icon">
                        <label class="sr-only" for="input-message">{{__("Message")}}</label>
                        <textarea
                                name="message" id="input-message" placeholder="Message" rows="4" cols="50"
                                data-toggle="tooltip" title="Message is required"
                                class="form-control placeholder"></textarea>
                        <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                    </div>

                    <div class="outer required">
                        <div class="form-group af-inner">
                            <input type="submit" name="submit"
                                   class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark"
                                   id="submit_btn" value="Send message"/>
                        </div>
                    </div>

                </form>
                <!-- /Contact form -->
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">

                <p>{{__("This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.")}}</p>

                <ul class="media-list contact-list">
                    <li class="media">
                        <div class="media-left"><i class="fa fa-home"></i></div>
                        <div class="media-body">{{__("Adress: 1600 Pennsylvania Ave NW, Washington, D.C.")}}</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa"></i></div>
                        <div class="media-body">{{__("DC 20500, ABD")}}</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-phone"></i></div>
                        <div class="media-body">{{__("Support Phone: 01865 339665")}}</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-envelope"></i></div>
                        <div class="media-body">{{__("E mails: info@example.com")}}</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-clock-o"></i></div>
                        <div class="media-body">{{__("Working Hours: 09:30-21:00 except on Sundays")}}</div>
                    </li>
                    <li class="media">
                        <div class="media-left"><i class="fa fa-map-marker"></i></div>
                        <div class="media-body">{{__("View on The Map")}}</div>
                    </li>
                </ul>

            </div>
        </div>

        <!-- /Get in touch -->

    </div>
</section>