<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{ (isset($coupon->id)) ?  __('Edit Coupon') :__('Add Coupon')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">


                        <form class="form-horizontal" method="POST"
                              action="{{ (isset($coupon->id)) ? route('admin.ecommerce.coupons.update',['users'=>$coupon->id]) : route('admin.ecommerce.coupons.store')   }}">
                            @csrf
                            @if(isset($coupon->id))
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


                                <div class="form-group">
                                    <label for="title" class="col-md-12">{{__('Coupon code')}}
                                        <span class="help">{{__('e.g. "NewYear"')}}</span></label>
                                    <div class="col-md-12">
                                        <input id="title" type="text" class="form-control" name="code"
                                               value="{{  old('code', isset($coupon->code) ? $coupon->code : '' )  }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="col-md-12">{{__('Select coupon type')}} </label>
                                    <div class="col-md-12">

                                        <select id="type" name="type" class="form-control"
                                        >
                                            <option {{selected(old('type', isset($coupon->type) ? $coupon->type : '' ), 'percent')}} value="percent">
                                                {{__('Percent')}}
                                            </option>
                                            <option {{selected(old('type', isset($coupon->type) ? $coupon->type : '' ), 'fixed')}}  value="fixed">
                                                {{__('Fixed')}}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="value" class="col-md-12">{{__('Coupon value')}} <span
                                                class="help">{{__('insert coupon price or percent value')}}</span></label>
                                    <div class="col-md-12">
                                        <input id="alias" type="text" name="value" class="form-control"
                                               value="{{  old('value', isset($coupon->value) ? $coupon->value : '' )  }}">
                                    </div>
                                </div>



                            </div>

                            <button type="submit"
                                    class="btn btn-success waves-effect waves-light m-r-10" style="margin-left: 8px;">
                                @if(isset($coupon->id))
                                    {{__('Update Coupon')}}
                                @else
                                    {{__('Add new Coupon')}}
                                @endif
                            </button>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>