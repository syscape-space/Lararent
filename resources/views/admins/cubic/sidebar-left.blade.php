<aside class="sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div class="profile-image">
                    {{--<img src="{{ asset(config('settings.admin')) }}/plugins/images/users/noavatar.png" alt="user-img"--}}
                    {{--class="img-circle">   --}}


                    @if(auth()->user()->img)
                        <img src="{{ the_image_url(auth()->user()->img,'thumbnail-70x70') }}"
                             alt="user-img"
                             class="img-circle"
                        >

                    @else
                        <img src="{{ asset(config('settings.admin')) }}/plugins/images/users/noavatar.png"
                             alt="user-img"
                             class="img-circle"
                        >

                    @endif

                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="{{route('admin.users.edit',['users' => $user->id])}}"><i
                                        class="fa fa-user"></i>{{__('admin.Profile')}}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('admin.users.edit',['users' => $user->id])}}"><i
                                        class="fa fa-cog"></i>{{__('admin.Account Settings')}}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i>{{__('admin.Logout')}}</a></li>
                    </ul>
                </div>
                <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);">{{$user->name}}</a></p>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="side-menu">

                @if(isset($backendMenu))
                    @foreach($backendMenu as $k => $v)

						<?php
						$allow = true;
						$auth_user =  Auth::user();

						if ( isset( $v['permissions'] ) && is_array( $v['permissions'] ) ) {
							foreach ( $v['permissions'] as $permission ) {
								$allow = $auth_user->can( $permission ) ? $auth_user->can( $permission ) : $auth_user->canDo( $permission ) ;
							}

						} elseif ( isset( $v['permissions'] ) ) {
							$allow =$auth_user->can( $v['permissions'] ) ?  $auth_user->can( $v['permissions'] ) : $auth_user->canDo( $v['permissions'] );

						}
						if($allow){

						$path = str_replace( request()->root() . '/', '', $v['url'] );


						?>


                        <li @if(request()->is($path.'/*')) class="active" @endif>

                            <a class=" waves-effect"

                               @if(!isset($v['sideMenu']))
                               href="{{$v['url']}}"
                               @else   href="javascript:void(0);"
                               @endif
                               aria-expanded="false"><i
                                        class="{{$v['icon'] ?? ''}} fa-fw"></i>
                                <span class="hide-menu"> {{$v['name'] ?? ''}}

                                    @if(isset($v['label']))
                                        <span class="label label-rounded label-info pull-right">{{$v['label']}}</span></span>
                                @endif
                            </a>

                            @if(isset($v['sideMenu']))
                                <ul aria-expanded="false" class="collapse">
                                    @foreach($v['sideMenu'] as $sideMenu)
										<?php
										$allowSide = true;

										$path = str_replace( request()->root() . '/', '', $sideMenu['url'] );


										if ( isset( $sideMenu['permissions'] ) && is_array( $sideMenu['permissions'] ) ) {
											foreach ( $sideMenu['permissions'] as $permission ) {

												$allowSide = $auth_user->can( $permission ) ? $auth_user->can( $permission ) : $auth_user->canDo( $permission );
											}

										} elseif ( isset( $v['permissions'] ) ) {
											$allowSide  =$auth_user->can( $v['permissions'] ) ?  $auth_user->can( $v['permissions'] ) : $auth_user->canDo( $v['permissions'] );

										}
										if($allowSide){
										?>
                                        <li @if(request()->is($path.'/*')) class="active" @endif><a
                                                    href="{{ $sideMenu['url'] ?? '' }}">{{ $sideMenu['name'] ?? '' }}</a>
                                        </li>
										<?php  } ?>

                                    @endforeach
                                </ul>
                            @endif
                        </li>
						<?php  } ?>

                    @endforeach
                @endif


            </ul>
        </nav>

    </div>
</aside>