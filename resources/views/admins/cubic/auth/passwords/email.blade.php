@extends('admins.'.config('settings.admin').'.layouts.auth')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST"   action="{{ route('password.email') }}">
        @csrf
        <div class="form-group ">
            <div class="col-xs-12">

                <h3> {{__('admin.Recover Password')}}</h3>
                <p class="text-muted"> {{__('admin.Enter your Email and instructions will be sent to you!')}} </p>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">

                <input id="email" type="email" placeholder="{{__('admin.Email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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