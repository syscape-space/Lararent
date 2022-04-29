<!-- PAGE -->
<section class="page-section no-padding slider">
    <div class="container full-width">

        <div class="main-slider">
            <div class="owl-carousel" id="main-slider">
                <!-- Slide 4 -->
                <div class="item slide4 ver4">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <h2 class="caption-title">{{__("For rental Cars")}}</h2>
                                        <h3 class="caption-subtitle"><span>{{__("Best Deals")}}</span></h3>
                                        <p class="caption-text">
                                            Sales Up %45 Off<br/>
                                            All Rental Cars Start from 49$
                                        </p>
                                        <p class="caption-text">
                                            <a class="btn btn-theme ripple-effect btn-theme-md"
                                               href="#">{{__("See All Vehicles")}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 4 -->

                <!-- Slide 1 -->
                <div class="item slide1 ver1">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
                                        <h2 class="caption-title">{{__('All Discounts Just For You')}}</h2>
                                        <h3 class="caption-subtitle">{{__('Find Best Rental Car')}}</h3>
                                        <!-- Search form -->
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10 col-md-offset-1">

                                                <div class="form-search dark">
                                                    <form action="{{ route('products.index') }}" method="get">
                                                        <div class="form-title">
                                                            <i class="fa fa-globe"></i>
                                                            <h2>{{__('Search for Cheap Rental Cars Wherever Your Are')}}</h2>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-6">
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
                                                                <div class="col-sm-3">
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
                                                                        <span class="form-control-icon">
                                                                            <i class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
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
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-6">
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
                                                                <div class="col-sm-3">
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
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">

                                                                    <div class="form-group has-icon has-label selectpicker-wrapper">
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
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-clock-o"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i>{{__(' ')}}
                                                                    <button type="submit" id="formSearchSubmit"
                                                                            class="btn btn-submit btn-theme pull-right">{{__("Find Car")}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /Search form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 1 -->

                <!-- Slide 2 -->
                <div class="item slide2 ver2">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
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
                                                                <label for="formSearchUpLocation2">{{__("Picking Up Location")}}</label>

                                                                <select name="PickingUpLocation"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip"
                                                                        id="formSearchUpLocation2"
                                                                >
                                                                    @if($locations ?? false)
                                                                        @foreach($locations as $location)


                                                                            <option
																				<?php  selected( old( 'PickingUpLocation', session( 'PickingUpLocation' ) ), $location->alias ); ?>
                                                                                value="{{$location->alias}}">{{$location->title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span class="form-control-icon">
                                                                    <i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffLocation2">{{__("Dropping Off Location")}}</label>
                                                                <select id="formSearchOffLocation2"
                                                                        name="DroppingOffLocation"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
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
                                                                <label for="formSearchUpDate2">{{__("Picking Up Date")}}</label>
                                                                <input
                                                                        name="PickingUpDate"
                                                                        class="PickingUpDate form-control datepicker"
                                                                        id="formSearchUpDate2"
                                                                        placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>{{__("Picking Up Hour")}}</label>
                                                                <select
                                                                        name="PickingUpHour"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">

																	<?php  $times = rentit_get_times(); ?>
                                                                    @if($times && is_array($times))
                                                                        @foreach($times as $time)
                                                                            <option
																				<?php  selected( old( 'PickingUpHour', session( 'PickingUpHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate2">{{__("Dropping Off Date")}}</label>
                                                                <input autocomplete="off"
                                                                       name="DroppingOffDate"
                                                                       type="text"
                                                                       class="form-control datepicker DroppingOffDate"
                                                                       id="formSearchOffDate2"
                                                                       placeholder="dd/mm/yyyy"
                                                                       value="{{session('DroppingOffDate')}}"
                                                                >
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>{{__("Dropping Off Hour")}}</label>
                                                                <select name="DroppingOffHour"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    @if($times && is_array($times))
                                                                        @foreach($times as $time)
                                                                            <option
																				<?php  selected( old( 'DroppingOffHour', session( 'DroppingOffHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-submit">
                                                    <div class="container-fluid">
                                                        <div class="inner">
                                                            <i class="fa fa-plus-circle"></i>{{__(" ")}}
                                                            <button type="submit" id="formSearchSubmit2"
                                                                    class="btn btn-submit btn-theme ripple-effect pull-right">{{__("Find Car")}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Search form -->

                                        <h2 class="caption-subtitle">Find Your Car!<br/>{{__(" Rent A Car Theme")}}</h2>
                                        <p class="caption-text">
                                            Vivamus in est sit amet risus rutrum facilisis sed ut mauris. Aenean aliquam
                                            ex ut sem aliquet, eget vestibulum erat pharetra. Maecenas vel urna nulla.
                                            Mauris non risus pulvinar.
                                        </p>
                                        <p class="caption-text">
                                            <a class="btn btn-theme ripple-effect btn-theme-md"
                                               href="#">{{__("See All Vehicles")}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 2 -->

                <!-- Slide 3 -->
                <div class="item slide3 ver3">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">
                                    <div class="caption-content">
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
                                                                <label for="formSearchUpLocation3">{{__("Picking Up Location")}}</label>
                                                                <select name="PickingUpLocation"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip"
                                                                        id="formSearchUpLocation3"
                                                                >
                                                                    @if($locations ?? false)
                                                                        @foreach($locations as $location)


                                                                            <option
																				<?php  selected( old( 'PickingUpLocation', session( 'PickingUpLocation' ) ), $location->alias ); ?>
                                                                                value="{{$location->alias}}">{{$location->title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>{{__("    ")}}<span
                                                                        class="form-control-icon"><i
                                                                            class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffLocation3">{{__("Dropping Off Location")}}</label>
                                                                <select id="formSearchOffLocation3"
                                                                        name="DroppingOffLocation"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
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
                                                                <label for="formSearchUpDate3">{{__("Picking Up Date")}}</label>
                                                                <input autocomplete="off"
                                                                       name="PickingUpDate"
                                                                       type="text"
                                                                       class="PickingUpDate form-control datepicker"
                                                                       id="formSearchUpDate3" placeholder="dd/mm/yyyy"
                                                                       value="{{session('PickingUpDate')}}"
                                                                >
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>{{__("Picking Up Hour")}}</label>
                                                                <select
                                                                        name="PickingUpHour"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">

																	<?php  $times = rentit_get_times(); ?>
                                                                    @if($times && is_array($times))
                                                                        @foreach($times as $time)
                                                                            <option
																				<?php  selected( old( 'PickingUpHour', session( 'PickingUpHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>

                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-inputs">
                                                    <div class="container-fluid">
                                                        <div class="col-sm-7">
                                                            <div class="form-group has-icon has-label">
                                                                <label for="formSearchOffDate3">{{__("Dropping Off Date")}}</label>
                                                                <input type="text"
                                                                       class="form-control datepicker DroppingOffDate"
                                                                       id="formSearchOffDate3" placeholder="dd/mm/yyyy">
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group has-icon has-label selectpicker-wrapper">
                                                                <label>{{__("Dropping Off Hour")}}</label>
                                                                <select name="DroppingOffHour"
                                                                        class="selectpicker input-price"
                                                                        data-live-search="true" data-width="100%"
                                                                        data-toggle="tooltip" title="Select">
                                                                    @if($times && is_array($times))
                                                                        @foreach($times as $time)
                                                                            <option
																				<?php  selected( old( 'DroppingOffHour', session( 'DroppingOffHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                                                                        @endforeach
                                                                    @endif

                                                                </select>
                                                                <span class="form-control-icon"><i
                                                                            class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row row-submit">
                                                    <div class="container-fluid">
                                                        <div class="inner">
                                                            <i class="fa fa-plus-circle"></i>{{__(" ")}}
                                                            <button type="submit" id="formSearchSubmit3"
                                                                    class="btn btn-submit ripple-effect btn-theme pull-right">{{__("Find Car")}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Search form -->

                                        <h2 class="caption-title">{{__("For rental Cars")}}</h2>
                                        <h3 class="caption-subtitle">{{__("Best Deals")}}</h3>
                                        <p class="caption-text">
                                            Sales Up %45 Off<br/>
                                            All Rental Cars Start from 49$
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slide 3 -->


            </div>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">

        <div class="row">
            <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s">
                <div class="thumbnail thumbnail-featured no-border no-padding">
                    <div class="media">
                        <a class="media-link" href="#">
                            <div class="caption">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-support"></i></div>
                                        <h4 class="caption-title">7/24 Car Support</h4>
                                        <div class="caption-text">{{__("Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.")}}</div>
                                        <div class="buttons">
                                            <span onclick="window.location.href='#'"
                                                  class="btn btn-theme ripple-effect btn-theme-transparent">{{__("Read More")}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption hovered">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-support"></i></div>
                                        <h4 class="caption-title">7/24 Car Support</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s" data-wow-delay="200ms">
                <div class="thumbnail thumbnail-featured no-border no-padding">
                    <div class="media">
                        <a class="media-link" href="#">
                            <div class="caption">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                        <h4 class="caption-title">{{__("Reservation Anytime")}}</h4>
                                        <div class="caption-text">{{__("Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.")}}</div>
                                        <div class="buttons">
                                            <span class="btn btn-theme ripple-effect btn-theme-transparent">{{__("Read More")}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption hovered">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-calendar"></i></div>
                                        <h4 class="caption-title">{{__("Reservation Anytime")}}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s" data-wow-delay="400ms">
                <div class="thumbnail thumbnail-featured no-border no-padding">
                    <div class="media">
                        <a class="media-link" href="#">
                            <div class="caption">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                        <h4 class="caption-title">{{__("Lots of Locations")}}</h4>
                                        <div class="caption-text">{{__("Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque,lacinia at tempor vitae, porta at arcu.")}}</div>
                                        <div class="buttons">
                                            <span class="btn btn-theme ripple-effect btn-theme-transparent">{{__("Read More")}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption hovered">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <div class="caption-icon"><i class="fa fa-map-marker"></i></div>
                                        <h4 class="caption-title">{{__("Lots of Locations")}}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section dark">
    <div class="container">

        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="100ms">
                <h2 class="section-title text-left">
                    <small>{{__("What Do You Know About Us")}}</small>
                    <span>Who We Are ?</span>
                </h2>
                <p>{{__("This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. ")}}</p>
                <ul class="list-icons">
                    <li>
                        <i class="fa fa-check-circle"></i>{{__("Lorem ipsum dolor sit amet, consectetur adipiscing elit.")}}
                    </li>
                    <li><i class="fa fa-check-circle"></i>{{__("Proin tempus sapien non iaculis pretium.")}}</li>
                </ul>
                <p class="btn-row">
                    <a href="#" class="btn btn-theme ripple-effect btn-theme-md">{{__("See All Vehicles")}}</a>
                    <a href="#"
                       class="btn btn-theme ripple-effect btn-theme-md btn-theme-transparent">{{__("Reservation Now")}}</a>
                </p>
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="300ms">
                <div class="owl-carousel img-carousel">
                    <div class="item"><a
                                href="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                data-gal="prettyPhoto"><img class="img-responsive"
                                                            src="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                                            alt=""/></a></div>
                    <div class="item"><a
                                href="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                data-gal="prettyPhoto"><img class="img-responsive"
                                                            src="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                                            alt=""/></a></div>
                    <div class="item"><a
                                href="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                data-gal="prettyPhoto"><img class="img-responsive"
                                                            src="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                                            alt=""/></a></div>
                    <div class="item"><a
                                href="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                data-gal="prettyPhoto"><img class="img-responsive"
                                                            src="{{ asset(config('settings.theme')) }}/assets/img/preview/slider/slide-775x500x1.jpg"
                                                            alt=""/></a></div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
            <small>{{__("What a Kind of Car You Want")}}</small>
            <span>{{__("Great Rental Offers for You")}}</span>

        </h2>

        <div class="tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">
            @if($terms)
                <ul id="tabs" class="nav">
                    @foreach($terms as $item)
                        @if($item->type == 'category')
                            <li class="{{($loop->index == 1 )?  'active' : ''}}">
                                <a href="#tab-{{$item->alias}}" data-toggle="tab">{{$item->title}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">

            @foreach($terms as $item)
                @if($item->type == 'category')
                    <div class="sladersss tab-pane fade  {{($loop->index == 1 )?  'active in' : ''}} "
                         id="tab-{{$item->alias}}">

                        <div class="swiper swiper--{{$item->alias}}">
                            <div class="swiper-container-GREAT-RENTAL swiper-container">

                                <div class="swiper-wrapper">

                                    <!-- Slides -->

                                    @if($item->products)
                                        @foreach($item->products as $product)
                                            <div class="swiper-slide">
                                                <div class="thumbnail no-border no-padding thumbnail-car-card">
                                                    <div class="media">

                                                        @if(isset($product->img) && $product->img > 0)

                                                            <a class="media-link" data-gal="prettyPhoto"
                                                               href="{{ the_image_url($product->img) }}">
                                                                <img src="{{ the_image_url($product->img,'thumbnail-370x220') }}"
                                                                     alt=""/>
                                                                <span class="icon-view"><strong><i
                                                                                class="fa fa-eye"></i></strong></span>
                                                            </a>
                                                        @endif

                                                    </div>
                                                    <div class="caption text-center">
                                                        <h4 class="caption-title"><a
                                                                    href="#">{{$product->title}}</a>
                                                        </h4>
                                                        <div class="caption-text">Start
                                                            from {{formatted_price($product->price)}}/per a day
                                                        </div>
                                                        <div class="buttons">
                                                            <a class="btn btn-theme ripple-effect"
                                                               href="{{route('products.show',['products'=> $product->alias ])}}">  {{get_theme_mod('rentit_rent_it',__('Rent It'))}}</a>
                                                        </div>
                                                        <table class="table">
                                                            <tr>
																<?php
																$product_meta = getProductMetas( $product );

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
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif


                                </div>

                            </div>

                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                        </div>

                    </div>
                @endif
            @endforeach
        </div>


    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section testimonials">
    <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials">
                <div class="testimonial">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object testimonial-avatar"
                                     src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg"
                                     alt="Testimonial avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span
                                        class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object testimonial-avatar"
                                     src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg"
                                     alt="Testimonial avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span
                                        class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object testimonial-avatar"
                                     src="{{ asset(config('settings.theme')) }}/assets/img/preview/avatars/testimonial-140x140x1.jpg"
                                     alt="Testimonial avatar">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="testimonial-text">{{__("Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.")}}</div>
                            <div class="testimonial-name">{{__("John Anthony Gibson ")}}<span
                                        class="testimonial-position">{{__("Co- founder at Rent It")}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
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
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section image">
    <div class="container">

        <div class="row">
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-heart"></i></div>
                        <div class="caption-number">{{__("5657")}}</div>
                        <h4 class="caption-title">{{__("Happy costumers")}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-car"></i></div>
                        <div class="caption-number">{{__("657")}}</div>
                        <h4 class="caption-title">{{__("Total car count")}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-flag"></i></div>
                        <div class="caption-number">{{__("1.255.657")}}</div>
                        <h4 class="caption-title">Total KM/MIL</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                <div class="thumbnail thumbnail-counto no-border no-padding">
                    <div class="caption">
                        <div class="caption-icon"><i class="fa fa-comments-o"></i></div>
                        <div class="caption-number">{{__("1255")}}</div>
                        <h4 class="caption-title">{{__("Call Center Solutions")}}</h4>
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

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>{{__("See What People Ask to Us")}}</small>
            <span>{{__("FAQS")}}</span>
        </h2>

        <div class="row">
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <!-- FAQ -->
                <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- faq1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"
                                   aria-expanded="true" aria-controls="collapse1">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="heading1">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq1 -->
                    <!-- faq2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading2">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2"
                                   aria-expanded="false" aria-controls="collapse2">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq2 -->
                    <!-- faq3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading3">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3"
                                   aria-expanded="false" aria-controls="collapse3">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq3 -->
                </div>
                <!-- /FAQ -->
            </div>
            <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="200ms">
                <!-- FAQ -->
                <div class="panel-group accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                    <!-- faq1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading21">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse21"
                                   aria-expanded="false" aria-controls="collapse21">
                                    <span class="dot"></span> How can ı dorp the rental car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse21" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading21">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq1 -->
                    <!-- faq2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading22">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapse22"
                                   aria-expanded="true" aria-controls="collapse22">
                                    <span class="dot"></span> Where can I rent a car?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse22" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="heading22">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq2 -->
                    <!-- faq3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading23">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse23"
                                   aria-expanded="false" aria-controls="collapse23">
                                    <span class="dot"></span> If I crash a car. What happens?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse23" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading23">
                            <div class="panel-body">
                                Duis bibendum diam non erat facilaisis tincidunt. Fusce leo neque, lacinia at tempor
                                vitae, porta at arcu. Vestibulum varius non dui at pulvinar. Ut egestas orci in quam
                                sollicitudin aliquet.
                            </div>
                        </div>
                    </div>
                    <!-- /faq3 -->
                </div>
                <!-- /FAQ -->
            </div>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section find-car dark">
    <div class="container">

        <form action="{{ route('products.index') }}" method="get" class="form-find-car">
            <div class="row">

                <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                    <h2 class="section-title text-left no-margin">
                        <small>{{__("Great Rental Cars")}}</small>
                        <span>{{__("Find your car")}}</span>
                    </h2>

                </div>
                <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="form-group has-icon has-label">

                        <label for="formFindCarLocation">{{__("Picking Up Location")}}</label>
                        <select name="PickingUpLocation"
                                class="selectpicker input-price"
                                data-live-search="true" data-width="100%"
                                data-toggle="tooltip"
                                id="formFindCarLocation"
                        >
                            @if($locations ?? false)
                                @foreach($locations as $location)


                                    <option
										<?php  selected( old( 'PickingUpLocation' ), $location->alias ); ?>
                                        value="{{$location->alias}}">{{$location->title}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>

                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                    <div class="form-group has-icon has-label">
                        <label for="formFindCarDate">{{__("Picking Up Date")}}</label>
                        <input type="text" class="form-control datepicker" id="formFindCarDate"
                               placeholder="dd/mm/yyyy">
                        <span class="form-control-icon"><i class="fa fa-calendar"></i></span>

                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                    <div class="form-group has-icon has-label">
                        <label for="formFindCarCategory">{{__("Price Category")}}</label>

                        <select name="group"
                                class="selectpicker input-price"
                                data-live-search="true" data-width="100%"
                                data-toggle="tooltip"
                                id="formFindCarCategory"
                        >
                            @if($terms ?? false)
                                @foreach($terms as $group)
                                    @if($group->type == 'group')
                                        <option
											<?php  selected( old( 'PickingUpLocation' ), $group->alias ); ?>
                                            value="{{$group->alias}}">{{$group->title}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                    <div class="form-group">
                        <button type="submit" id="formFindCarSubmit"
                                class="btn btn-block btn-submit ripple-effect btn-theme">{{__("Find Car")}}</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section no-padding no-bottom-space-off">
    <div class="container full-width">

        <!-- Google map -->
        <div class="google-map">
            <div id="map-canvas"></div>
        </div>
        <!-- /Google map -->

    </div>
</section>

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


<!-- PAGE -->
<section class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>{{__("Rental Magazine Here")}}</small>
            <span>{{__("Recent Blog Posts")}}</span>
        </h2>

        <div class="row">
            @if($posts)
                @foreach($posts as $post)
                    <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-link" href="#">
                                    <div class="badge type">{{__("Car Service")}}</div>
                                    <div class="badge post"><i class="fa  fa-image"></i></div>
                                    @if(isset($post->img) && $post->img > 0)

                                        <img class="media-object" src="{{ the_image_url($post->img,'thumbnail-570x270 ') }}">
                                        <i class="fa fa-plus"></i>

                                    @endif
                                </a>
                                <div class="media-left">
                                    <div class="meta-date">
                                        <div class="day">{{$post->created_at->format('d') ?? ''}}</div>
                                        <div class="month">{{$post->created_at->format('M') ?? ''}}</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="media-meta">
                                        {{__('By')}}{{$post->user->name ?? ''}}
                                    </div>
                                    <h4 class="media-heading"><a
                                                href="{{ route('posts.show',['alias' => $post->alias]) }}">{{$post->title}}</a></h4>
                                    <div class="media-excerpt">{{$post->desc}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="text-center margin-top wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <a href="{{ route('posts.index') }}" class="btn btn-theme ripple-effect btn-theme-light btn-more-posts">{{__("See All Posts")}}</a>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section image subscribe">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>{{__("You Can Follow Us By E Mail")}}</small>
            <span>{{__("Subscrıbe")}}</span>
        </h2>

        <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
            <div class="col-md-8 col-md-offset-2">

                <p class="text-center">{{__("This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.")}}</p>

                <!-- Subscribe form -->
                <form action="#" class="form-subscribe mail-chimp">
                    <div class="form-group">
                        <label for="formSubscribeEmail" class="sr-only">{{__("Enter your email here")}}</label>
                        <input type="text" class="form-control" id="formSubscribeEmail"
                               placeholder="Enter your email here" title="Email is required">
                    </div>
                    <button type="submit"
                            class="btn btn-submit btn-theme ripple-effect btn-theme-dark">{{__("Subscribe")}}</button>
                </form>
                <!-- Subscribe form -->

            </div>
        </div>

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>{{__("Do You Have Any Question or Anything else ")}}</small>
            <span>{{__("Costumer service")}}</span>
        </h2>

        <!-- Team row -->
        <div class="row">

            <!-- Team 1 -->
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                <div class="thumbnail thumbnail-team no-border no-padding">
                    <div class="media">
                        <img src="{{ asset(config('settings.theme')) }}/assets/img/preview/team/team-270x270x1.jpg"
                             alt=""/>
                    </div>
                    <div class="caption">
                        <h4 class="caption-title">{{__("Kelly Doe Surname ")}}
                            <small>{{__("Costumer Service")}}</small>
                        </h4>
                        <ul class="team-details">
                            <li>{{__("Skype: team.member")}}</li>
                            <li>{{__("Tel: 555 555-5555")}}</li>
                            <li><a href="mailto:supportname@gmail.com">{{__("supportname@gmail.com")}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Team 1 -->

            <!-- Team 2 -->
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                <div class="thumbnail thumbnail-team no-border no-padding">
                    <div class="media">
                        <img src="{{ asset(config('settings.theme')) }}/assets/img/preview/team/team-270x270x2.jpg"
                             alt=""/>
                    </div>
                    <div class="caption">
                        <h4 class="caption-title">{{__("Name and Surname ")}}
                            <small>{{__("Team Title")}}</small>
                        </h4>
                        <ul class="team-details">
                            <li>{{__("Skype: team.member")}}</li>
                            <li>{{__("Tel: 555 555-5555")}}</li>
                            <li><a href="mailto:supportname@gmail.com">{{__("supportname@gmail.com")}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Team 2 -->

            <!-- Team 3 -->
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                <div class="thumbnail thumbnail-team no-border no-padding">
                    <div class="media">
                        <img src="{{ asset(config('settings.theme')) }}/assets/img/preview/team/team-270x270x3.jpg"
                             alt=""/>
                    </div>
                    <div class="caption">
                        <h4 class="caption-title">{{__("Jane Elizabeth ")}}
                            <small>{{__("Tech-Support")}}</small>
                        </h4>
                        <ul class="team-details">
                            <li>{{__("Skype: team.member")}}</li>
                            <li>{{__("Tel: 555 555-5555")}}</li>
                            <li><a href="mailto:supportname@gmail.com">{{__("supportname@gmail.com")}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Team 3 -->

            <!-- Team 4 -->
            <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                <div class="thumbnail thumbnail-team no-border no-padding">
                    <div class="media">
                        <img src="{{ asset(config('settings.theme')) }}/assets/img/preview/team/team-270x270x4.jpg"
                             alt=""/>
                    </div>
                    <div class="caption">
                        <h4 class="caption-title">{{__("Anthony Hopkins ")}}
                            <small>{{__("Costumer Service")}}</small>
                        </h4>
                        <ul class="team-details">
                            <li>{{__("Skype: team.member")}}</li>
                            <li>{{__("Tel: 555 555-5555")}}</li>
                            <li><a href="mailto:supportname@gmail.com">{{__("supportname@gmail.com")}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Team 4 -->

        </div>
        <!-- /Team row -->

    </div>
</section>
<!-- /PAGE -->

<!-- PAGE -->
<section class="page-section contact dark">
    <div class="container">

        <!-- Get in touch -->

        <h2 class="section-title wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
            <small>Feel Free to Say Hello!</small>
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