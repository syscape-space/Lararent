@extends('admins.'.config('settings.admin').'.layouts.auth')

@section('content')


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal form-material" method="POST" action="{{ route('password.request') }}">
        @csrf

        <h3 class="box-title m-b-20">{{ __('admin.Reset Password') }}</h3>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <div class="col-xs-12">

                <input id="email" placeholder="Email" type="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                       value="{{ $email ?? old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

            </div>
        </div>


        <div class="form-group ">

            <div class="col-xs-12">
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password"
                       placeholder="{{ __('admin.Password') }}"
                       required

                >

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group ">

            <div class="col-md-12">
                <input placeholder="{{ __('admin.Password confirm') }}"  id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light">
                    {{ __('admin.Reset Password') }}
                </button>
            </div>
        </div>
    </form>


@endsection
