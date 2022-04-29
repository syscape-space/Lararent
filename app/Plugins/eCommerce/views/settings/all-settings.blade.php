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

                    <form  action="{{route('admin.ecommerce.settings.store')}}" method="post" class="col-md-6">
                        @csrf

                        <h4 class="box-title">{{__('Currency options')}}</h4>
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

                        <div class="form-body">


                            <div class="form-group">
                                <label for="currency">{{__('Currency symbol')}}</label>
                                <input name="currency" type="text" required="" class="form-control"
                                       id="currency" value="{{  old('currency', isset($settings['currency']) ? $settings['currency'] : '' )  }}"
                                       placeholder=""
                                >
                            </div>
     <div class="form-group">
                                <label for="currency">{{__('Currency code')}}</label>
         <smail>{{__('you can see it here')}} <a target="_blank" href="https://en.wikipedia.org/wiki/ISO_4217#Position_of_ISO_4217_code_in_amounts">https://en.wikipedia.org/wiki/ISO_4217#Position_of_ISO_4217_code_in_amounts</a>  </smail>
                                <input name="currency_code" type="text" required="" class="form-control"
                                       id="currency" value="{{  old('currency_code', isset($settings['currency_code']) ? $settings['currency_code'] : '' )  }}"
                                       placeholder=""
                                >
                            </div>


                            <div class="form-group">
                                <label for="currency_pos">{{__('Currency position:')}}</label>

                                <select class="form-control" name="currency_pos" id="currency_pos">
                                    <option value="left"
                                          <?php  selected('left',isset($settings['currency_pos']) ? $settings['currency_pos'] : '' ) ?> >
                                        {{__('Left')}}
                                    </option>
                                    <option value="right"
                                    <?php  selected('right',isset($settings['currency_pos']) ? $settings['currency_pos'] : '' ) ?>
                                    >
                                        {{__('Right')}}
                                    </option>
                                    <option value="left_space"
                                    <?php  selected('left_space',isset($settings['currency_pos']) ? $settings['currency_pos'] : '' ) ?>
                                    >
                                        {{__(' Left with space')}}
                                    </option>
                                    <option value="right_space"
                                    <?php  selected('right_space',isset($settings['currency_pos']) ? $settings['currency_pos'] : '' ) ?>
                                    >
                                        {{__('Right with space')}}
                                    </option>

                                </select>
                            </div>

                            <div class="row">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_thousand_sep">{{__('Thousand separator')}}</label>

                                        <input name="price_thousand_sep" type="text" required="" class="form-control"
                                               id="price_thousand_sep" value=","
                                               placeholder=","
                                        >
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_decimal_sep">{{__('Decimal separator')}}</label>

                                        <input name="price_decimal_sep" type="text" required="" class="form-control"
                                               id="price_decimal_sep" value="{{  old('currency_code', isset($settings['price_decimal_sep']) ? $settings['price_decimal_sep'] : '.' )  }}"
                                               placeholder="."
                                        >
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_num_decimals">{{__('Number of decimals')}}</label>

                                        <input name="price_num_decimals" type="number" required="" class="form-control"
                                               id="price_num_decimals" value="{{  old('currency_code', isset($settings['price_num_decimals']) ? $settings['price_num_decimals'] : '2' )  }}"
                                               placeholder="2"
                                        >
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">
                                        {{__('Save options')}}
                                    </button>
                                </div>


                            </div>


                        </div>
                    </form>




                </div>
                <hr>

            </div>
        </div>
    </div>


</div>