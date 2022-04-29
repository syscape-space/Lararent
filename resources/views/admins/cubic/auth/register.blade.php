@extends('admins.'.config('settings.admin').'.layouts.auth')

@section('content')

    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('register') }}">
        @csrf
        <h3 class="box-title m-b-20">{{__('admin.Sign Up')}}</h3>

        <div class="form-group ">
            <div class="col-xs-12">

                <input class="form-control {{ $errors->has('login') ? ' is-invalid' : '' }}"
                       type="text"
                       name="login"
                       value="{{ old('login') }}" required="" placeholder=" {{__('admin.Login')}}">
                @if ($errors->has('login'))
                    <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
				    </span>
                @endif

            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                       type="text" required=""
                       name="name"
                       value="{{ old('name') }}" placeholder=" {{__('admin.Name')}}">
                @if ($errors->has('name'))
                    <span class="help-block">

				                                             <strong>{{ $errors->first('name') }}</strong>
				                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email"
                       value="{{ old('email') }}"
                       type="text" required=""
                       placeholder="{{__('admin.Email')}}">
                @if ($errors->has('email'))
                    <span class="help-block">
				                                        <strong>{{ $errors->first('email') }}</strong>
				                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password"
                       type="password"
                       required=""
                       placeholder="{{__('admin.Password')}}">
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control"
                       name="password_confirmation"
                       type="password" required=""
                       placeholder=" {{__('admin.Confirm Password')}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary p-t-0">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup"> {{__('admin.I agree to all')}} <a href="#">{{__('admin.Terms')}}</a></label>
                </div>
            </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                        type="submit"> {{__('admin.Sign Up')}}
                </button>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <p> {{__('admin.Already have an account?')}}
                    <a href="{{url(route('login'))}}" class="text-primary m-l-5"><b> {{__('admin.Sign In')}}</b></a></p>
            </div>
        </div>

    </form>


@endsection