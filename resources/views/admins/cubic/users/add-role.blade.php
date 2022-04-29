<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @if(isset($user->id))
                        {{__('admin.Edit user')}} "{{$user->name}}"
                    @else
                        {{__('admin.add new user')}}
                    @endif
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">{{__('admin.Create a brand new user and add them to this site.')}}
                                </h3>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <form method="post"
                                              action="{{  (isset($user->id)) ? route('admin.users.update',['users'=>$user->id]) : route('admin.users.store')  }}">
                                            @csrf
                                            @if(isset($user->id))
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



                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{__('admin.Role')}}</label>

                                                </div>

                                                <button type="submit"
                                                        class="btn btn-success waves-effect waves-light m-r-10">
                                                    @if(isset($user->id))
                                                        {{__('admin.Edit user')}}
                                                    @else
                                                        {{__('admin.Add New User')}}
                                                    @endif
                                                </button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

