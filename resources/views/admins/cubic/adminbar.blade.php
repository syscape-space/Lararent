<div id="lradminbar" class="">

    <div class="quicklinks" id="lr-toolbar" role="navigation" aria-label="Toolbar" tabindex="0">
        <ul id="lr-admin-bar-root-default" class="ab-top-menu">

            <li id="lr-admin-bar-site-name" class="menupop"><a class="ab-item" aria-haspopup="true"
                                                               href="{{route('adminIndex')}}">{{__('admin.Admin panel')}}</a>
                <div class="ab-sub-wrapper">
                    <ul id="lr-admin-bar-site-name-default" class="ab-submenu">
                        <li id="lr-admin-bar-dashboard"><a class="ab-item"
                                                           href="{{route('adminIndex')}}">{{__('admin.Dashboard')}}</a>
                        </li>
                    </ul>
                    <ul id="lr-admin-bar-appearance" class="ab-submenu">
                        <li id="lr-admin-bar-themes"><a class="ab-item"
                                                        href="{{route( 'admin.themes.index' )}}">{{__('admin.Themes')}}</a>
                        </li>
                        <li id="lr-admin-bar-widgets"><a class="ab-item"
                                                         href="{{route( 'admin.widgets.index' )}}">{{__('admin.Widgets')}}</a>
                        </li>
                        <li id="lr-admin-bar-menus"><a class="ab-item"
                                                       href="{{route( 'admin.menus.index' )}}">{{__('admin.Menus')}}</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li id="lr-admin-bar-edit">

				<?php


				$routeArray = app( 'request' )->route()->getAction();
				$controllerAction = class_basename( $routeArray['controller'] );

				if($controllerAction == 'PostsController@show' && isset( app( 'request' )->route()->controller->post_id )){
				?>
                <a class="ab-item"
                   href="{{route('admin.posts.edit',['id' => app( 'request' )->route()->controller->post_id ])}}">{{__('admin.Edit Post')}}</a>
				<?php  } elseif(isset( app( 'request' )->route()->controller->cat_id )) {
				?>
                <a class="ab-item"
                   href="{{route('admin.categories.edit',['id' => app( 'request' )->route()->controller->cat_id ])}}">{{__('admin.Edit Category')}}</a>
				<?php
				} ?>

                @action('adminbar.edit', $controllerAction)

            </li>

            <li>

                <a class="ab-item"
                   href="{{route('admin.customize.index',['url' =>Request::fullUrl() ])}}">{{__('admin.Customize')}}</a>
            </li>

        </ul>
        <ul id="lr-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">

            <li id="lr-admin-bar-search" class="admin-bar-search">
                <div class="ab-item ab-empty-item" tabindex="-1">
                    <form action="https://rentit.lrmix.net/" method="get" id="adminbarsearch"><input
                                class="adminbar-input" name="s" id="adminbar-search" type="text" value=""
                                maxlength="150"><label for="adminbar-search"
                                                       class="screen-reader-text">{{__('admin.Search')}}</label><input
                                type="submit"
                                class="adminbar-button"
                                value="Search">
                    </form>
                </div>
            </li>
            <li id="lr-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true"
                                                                            href="">{{__('admin.Howdy,')}}<span
                            class="display-name">{{$user->name ?? ''}}</span>


                    @if(auth()->user()->img)
                        <img src="{{ the_image_url(auth()->user()->img,'thumbnail-70x70') }}"
                             alt="user-img"
                             class="avatar avatar-26 photo"
                        >

                    @else
                        <img src="{{ asset(config('settings.admin')) }}/plugins/images/users/noavatar.png"
                             alt="user-img"
                             class="avatar avatar-26 photo"
                        >

                    @endif

                </a>
                <div class="ab-sub-wrapper">
                    <ul id="lr-admin-bar-user-actions" class="ab-submenu">
                        <li id="lr-admin-bar-user-info"><a class="ab-item" tabindex="-1"
                                                           href="{{route('admin.users.edit',['users' => auth()->user()->id])}}">

                                @if(auth()->user()->img)
                                    <img src="{{ the_image_url(auth()->user()->img,'thumbnail-70x70') }}"
                                         alt="user-img"
                                         class="avatar avatar-64 photo"
                                    >

                                @else
                                    <img src="{{ asset(config('settings.admin')) }}/plugins/images/users/noavatar.png"
                                         alt="user-img"
                                         class="avatar avatar-64 photo"
                                    >

                                @endif


                                <span
                                        class="display-name">{{ Auth::user()->name }}</span></a></li>
                        <li id="lr-admin-bar-edit-profile"><a class="ab-item"
                                                              href="{{route('admin.users.edit',['id' => $user->id ])}}">{{__('admin.Edit My Profile')}}</a>
                        </li>
                        <li id="lr-admin-bar-logout"><a class="ab-item"
                                                        href="{{route('logout')}}">{{__('admin.Log Out')}}</a></li>
                    </ul>
                </div>
            </li>


            @action('adminbar.center', $controllerAction)
            <li id="lr-admin-bar-comet_cache-clear" class="-clear"><a class="ab-item" tabindex="-1"
                                                                      href="{{route('lr-clear-cache')}}">{{__('admin.Clear Cache')}}</a>
            </li>
        </ul>
    </div>
    <a class="screen-reader-shortcut" href="{{route('logout')}}">{{__('admin.Log Out')}}</a>
</div>