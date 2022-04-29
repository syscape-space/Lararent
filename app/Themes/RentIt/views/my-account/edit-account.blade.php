<div class="row">
    <div class="col-md-3">
        <div class="widget shadow car-categories">

            <div class="widget-content">

                <ul>
                    <li>
                        <a
                                href="{{route('MyAccount')}}">{{__('My bookings')}}</a>

                    </li>
                    <li class="active">
                        <span class="arrow"></span><a
                                href="{{route('MyAccountEdit')}}">{{__('Edit account')}}</a>

                        <ul class="children" style="display: none;"></ul>
                    </li>
                    <li>
                       <a
                                href="{{route('logout')}}">{{__('Log out')}}</a>

                        <ul class="children" style="display: none;"></ul>
                    </li>


                </ul>

            </div>
        </div>

    </div>

    <div class="col-md-9">
        <h1  class="post-title" >Edit account</h1>
        <form method="post"
              action="{{  route('MyAccountUpdateAccount')  }}">
            @csrf


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
                    <label for="exampleInputUsers">{{__('admin.User Name')}}</label>
                    <input name="name"
                           type="text"
                           required class="form-control"
                           id="exampleInputUsers"
                           value="{{  old('name', isset($user->name) ? $user->name : '' )  }}"
                           placeholder="{{__('admin.Enter Username')}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputUsers">{{__('admin.User login')}}</label>
                    <input name="login"
                           type="text"
                           required class="form-control"
                           id="exampleInputUsers"
                           value="{{  old('login', isset($user->login) ? $user->login : '' )  }}"
                           placeholder="{{__('admin.Enter Username')}}">
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('admin.Email address')}}</label>
                    <input name="email"
                           value="{{  old('email', isset($user->email) ? $user->email : '' )  }}"
                           type="email"
                           required
                           class="form-control"
                           id="exampleInputEmail1"
                           placeholder="{{__('admin.Enter email')}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('admin.Password')}}</label>
                    <input name="password" type="password" class="form-control"
                           id="exampleInputPassword1" placeholder="{{__('admin.Password')}}"></div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('admin.Password')}}</label>
                    <input name="password_confirmation" type="password"
                           class="form-control" id="exampleInputPassword1"
                           placeholder="{{__('admin.Confirm Password')}}"></div>





                <button type="submit"
                        class="btn btn-success waves-effect waves-light m-r-10">
                    @if(isset($user->id))
                        {{__('Update')}}
                    @endif
                </button>
            </div>

        </form>

    </div>

</div>

