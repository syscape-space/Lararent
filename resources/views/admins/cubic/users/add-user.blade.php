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
                                                    <label for="exampleInputUsers2">{{__('admin.User login')}}</label>
                                                    <input name="login"
                                                           type="text"
                                                           required class="form-control"
                                                           id="exampleInputUsers2"
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
                                                           id="exampleInputPassword1"
                                                           placeholder="{{__('admin.Password')}}"></div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword2">{{__('admin.Password')}}</label>
                                                    <input name="password_confirmation" type="password"
                                                           class="form-control" id="exampleInputPassword2"
                                                           placeholder="{{__('admin.Confirm Password')}}"></div>


                                                @if(auth()->user()->isSuperAdmin())
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{__('admin.Role')}}</label>


                                                        <select class="form-control" name="role_id" id="role">
                                                            <option value="">-- {{__('admin.Select role')}}</option>
                                                            @if(isset($roles) && is_array($roles) )
                                                                @foreach($roles as $k => $v)
                                                                    <option @if( isset($user) &&  isset($user->roles()->first()->id ) &&  $user->roles()->first()->id ==$k ) selected
                                                                            @endif value="{{$k}}">{{$v}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                    </div>
                                                @endif

                                                <div class="">
                                                    <h3 class="box-title m-t-20">
                                                        <strong>{{__('admin.Avatar')}} </strong></h3>
                                                    <div class="product-img">

                                                        @if(isset($user->img))
                                                            <img class="img-responsive"
                                                                 src="{{ the_image_url($user->img,'thumbnail-260x260') }}">
                                                            <input type="hidden" name="img" value="{{$user->img}}"
                                                                   class="featured_image_id">
                                                        @else
                                                            <img class="img-responsive"
                                                                 src="{{ asset(config('settings.admin')) }}/plugins/images/placeholder.png">
                                                            <input type="hidden" name="img" value=""
                                                                   class="featured_image_id">
                                                        @endif


                                                        <br>
                                                        <br>

                                                        <div
                                                                class="set_media fileupload btn btn-info waves-effect waves-light">
                                                                <span><i class="ion-upload m-r-5"></i>
                                                                    {{__('admin.Set Avatar Image')}} </span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                        class="btn btn-success waves-effect waves-light m-r-10">
                                                    @if(isset($user->id))
                                                        {{__('admin.Edit user')}}
                                                    @else
                                                        {{__('admin.add new user')}}
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

<script>
    // $(document).ready(function () {


    jQuery(document).ready(function ($) {


        $('.set_media').click(function (e) {
            mediaLibrary.open();
            var button = $(this);
            $('#mediaLibrary-modal').on('mediaLibrary.stateChange', function (e, img_id, img_src) {
                var img_f = button.closest('.product-img');
                img_f.find('img').attr('src', img_src);
                img_f.find('input').val(img_id);
            });
        });


        ////////////////////////////////////////////////

    });

</script>


