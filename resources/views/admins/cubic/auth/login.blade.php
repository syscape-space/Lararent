@extends('admins.'.config('settings.admin').'.layouts.auth')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal form-material" id="loginform"  method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="box-title m-b-20">{{__('admin.Sign In')}}</h3>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text"  name="login" required="" placeholder="{{__('admin.Username')}}">
                @if ($errors->has('login'))
                    <span class="help-block">
				                                        <strong>{{ $errors->first('login') }}</strong>
				                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">

                <input id="password" placeholder="{{ __('admin.Password') }}"
                       type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary pull-left p-t-0">

                    <input  id="checkbox-signup"  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="checkbox-signup">{{ __('admin.Remember Me') }}</label>
                </div>
                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i>
                    {{__('admin.Forgot pwd?')}}
                </a> </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    {{__('admin.Log In')}}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">

            </div>
        </div>
        <div class="form-group m-b-0">
            {{--<div class="col-sm-12 text-center">--}}
                {{--<p>{{__('admin.Don\'t have an account?')}} <a href="{{ route('register') }}" class="text-primary m-l-5"><b>--}}
                            {{--{{__('admin.Sign Up')}}</b></a></p>--}}
            {{--</div>--}}
        </div>
    </form>
    <form class="form-horizontal" method="POST"  id="recoverform" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group ">
            <div class="col-xs-12">
                <h3>{{__('admin.Recover Password')}}</h3>
                <p class="text-muted">{{__('admin.Enter your Email and instructions will be sent to you!')}} </p>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">

                <input id="email" type="email" placeholder=">{{__('admin.Email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    {{__('admin.Reset')}}
                </button>
            </div>
        </div>
    </form>


@endsection