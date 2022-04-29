<div class="widget shadow widget-find-car">
    <h4 class="widget-title">{{$title ?? ''}}</h4>
    <div class="widget-content">
        <!-- Search form -->
        <div class="form-search light">
            <form action="{{ route('products.index') }}" method="get">

                <div class="form-group has-icon has-label">
                    <label for="formSearchUpLocation3">{{__('Picking Up Location')}}</label>
                    <select name="PickingUpLocation"
                            class="selectpicker input-price"
                            data-live-search="true" data-width="100%"
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
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>

                <div class="form-group has-icon has-label">
                    <label for="formSearchOffLocation">{{__('Dropping Off Location')}}</label>
                    <select id="formSearchOffLocation" name="DroppingOffLocation"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="{{__('Select')}}">
                        @if($locations)
                            @foreach($locations as $location)

                                <option
									<?php  selected( old( 'DroppingOffLocation', session( 'DroppingOffLocation' ) ), $location->alias ); ?>
                                    value="{{$location->alias}}">{{$location->title}}</option>

                            @endforeach
                        @endif
                    </select>
                    <span class="form-control-icon"><i class="fa fa-map-marker"></i></span>
                </div>

                <div class="form-group has-icon has-label">
                    <label for="formSearchUpDate3">{{__('Picking Up Date')}}</label>
                    <input autocomplete="off"
                           name="PickingUpDate"
                           type="text"
                           class="PickingUpDate form-control datepicker"
                           id="formSearchUpDate" placeholder="dd/mm/yyyy"
                           value="{{session('PickingUpDate')}}"
                    >
                    <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                </div>
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

                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>{{__('Picking Up Hour')}}</label>
                    <select
                            name="PickingUpHour"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="{{__('Select')}}">

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


                <div class="form-group has-icon has-label selectpicker-wrapper">
                    <label>{{__('Dropping Off Hour')}}</label>
                    <select name="DroppingOffHour"
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="{{__('Select')}}">
                        @if($times && is_array($times))
                            @foreach($times as $time)
                                <option
									<?php  selected( old( 'DroppingOffHour', session( 'DroppingOffHour' ) ), $time ); ?> value="{{$time}}">{{$time}}</option>
                            @endforeach
                        @endif

                    </select>
                    <span class="form-control-icon"><i class="fa fa-clock-o"></i></span>
                </div>

                <div class="form-group selectpicker-wrapper">
                    <label>{{__('Select Category')}}</label>
                    <select
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="{{__('Select')}}" name="category">
                        <option value="0">{{__('Select Category')}}</option>
                        @if($category_list ?? false)
                            @foreach($category_list as $item)
                                <option <?php  selected( old( 'category', request()->category ?? '' ), $item->alias ); ?> value="{{$item->alias ?? ''}}">{{$item->title ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group selectpicker-wrapper">
                    <label>{{__('Select Type')}}</label>
                    <select
                            class="selectpicker input-price" data-live-search="true" data-width="100%"
                            data-toggle="tooltip" title="{{__('Select')}}" name="group">
                        <option value="0">{{__('Select Type')}}</option>
                        @if($group_list ?? false)
                            @foreach($group_list as $item)
                                <option  <?php  selected( old( 'group', request()->group ?? '' ), $item->alias ); ?> value="{{$item->alias ?? ''}}">{{$item->title ?? ''}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme btn-theme-dark btn-block">
                    {{__('Find Car')}}
                </button>

            </form>
        </div>
        <!-- /Search form -->
    </div>
</div>