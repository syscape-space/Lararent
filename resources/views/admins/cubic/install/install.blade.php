@extends('admins.'.config('settings.admin').'.layouts.auth')

@section('content')

    <form class="form-horizontal form-material" id="loginform" action="#" method="post">
        @csrf
        <h2 class="box-title m-b-20">Database Server</h2>
        <hr>


        @if ( is_array(Session::get('error')) && count(Session::get('error')) > 0)

            <div class="row">
                <div class="col-md-12">
                    @foreach (Session::get('error') as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach

                </div>

            </div>
        @endif
        @if(session()->get('error') && !is_array(session()->get('error')))
            <div class="row">
                <div class="col-md-12">

                    <div class="alert alert-danger">{{ session()->get('error') }}</div>

                </div>

            </div>

        @endif

        <div class="form-group ">
            <div class="col-xs-12">
                <label>
                    Hostname (instead of localhost you need use 127.0.0.1)

                    <input class="form-control" required type="text" value="{{  old('title', '127.0.0.1' ) }}"
                           name="db_hostname" placeholder="127.0.0.1">
                </label>
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">

                <input class="form-control" required type="text" value="{{  old('db_username') }}" name="db_username"
                       placeholder="Username ">

            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" required type="text" value="{{  old('db_password') }}" name="db_password"
                       placeholder="Password">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" required type="text" value="{{  old('db_database') }}" name="db_database"
                       placeholder="Database">
            </div>
        </div>


        <h2 class="box-title m-b-20">Create Admin user</h2>
        <hr>
        <h4 class="text-center">Login Information
        </h4>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" value="{{  old('login') }}" required name="login"
                       placeholder="Login">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="text" value="{{  old('name') }}" required name="name"
                       placeholder="Name">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="email" value="{{  old('email') }}" name="email" required
                       placeholder="Email">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-12">
                <input class="form-control" type="password" value="{{  old('password') }}" name="password" required
                       placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" value="{{  old('password_confirmation') }}"
                       name="password_confirmation" required placeholder="Confirm Password">
            </div>
        </div>

        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">
                    Install
                </button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary p-t-0">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                </div>
            </div>
        </div>
    </form>
    <style>
        .login-box {
            margin-top: 1%;
            width: 520px;
            margin-bottom: -20px;
        }

        .login-register {
            /* position: static;*/

        }

        .white-box {

            overflow-y: scroll;
            /* padding: 0px 0px 0px 5px; */
            /* position: relative; */
            /* z-index: 3; */
            height: 95vh;
        }

    </style>
@endsection