<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__("admin.General Settings")}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <form method="post" action="{{route('admin.options.store')}}" class="form-horizontal">
                            @csrf
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

                            <div class="col-md-6">
                                <div class="">

                                    <h3 class="box-title m-b-0">{{__("admin.GENERAL SETTINGS")}}</h3>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">


                                            <div class="form-group">
                                                <label for="blogname" class="col-sm-3 control-label">{{__("admin.Site Title")}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="blogname"
                                                           class="form-control"
                                                           id="blogname"
                                                           value="{{  old('blogname', isset($options['blogname']) ? $options['blogname'] : '' )  }}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="blogdescription" class="col-sm-3 control-label">{{__("admin.Tagline")}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                           name="blogdescription"
                                                           class="form-control"
                                                           id="blogdescription"
                                                           value="{{  old('blogdescription', isset($options['blogdescription']) ? $options['blogdescription'] : '' )  }}"
                                                    >


                                                    <small>{{__("admin.In a few words, explain what this site is about.")}}</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="blogname" class="col-sm-3 control-label">{{__("admin.Select title for seo")}}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="seo_title"
                                                           class="form-control"
                                                           id="blogname"
                                                           value="{{  old('seo_title', isset($options['seo_title']) ? $options['seo_title'] : '%controller_title% > %site_title%' )  }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="admin_email" class="col-sm-3 control-label">{{__('admin.Admin Email*')}}</label>
                                                <div class="col-sm-9">
                                                    <input
                                                            name="admin_email"
                                                            type="email"
                                                            class="form-control"
                                                            id="admin_email"
                                                            placeholder="Email"
                                                            value="{{  old('blogdescription', isset($options['admin_email']) ? $options['admin_email'] : '' )  }}"
                                                    >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPassword4" class="col-sm-3 control-label">{{__("admin.Default Site Language")}}</label>
                                                <div class="col-sm-9">

                                                    <select name="LANG" id="WPLANG" class="form-control">
                                                        <optgroup label="Installed">

                                                            @foreach($available_langs as $lang)

                                                                <option value="{{$lang}}" lang="{{$lang}}"
                                                                        data-installed="1"
																<?php  selected($lang, getOption('LANG', 'en')) ?>>{{ $langs[$lang] ?? $lang }}
                                                                </option>
                                                            @endforeach

                                                        </optgroup>

                                                    </select>
                                                </div>


                                            </div>


                                            <div class="form-group">
                                                <label for="admin_email" class="col-sm-3 control-label">{{__("admin.Add custom language")}}</label>
                                                <div class="col-sm-9">
                                                    <small>
                                                    </small>
                                                    <table id="langs-table"
                                                           class="table color-table purple-table">

                                                        <thead>
                                                        <tr>
                                                            <th>{{__("admin.Language code")}}</th>
                                                            <th>{{__("admin.Language name")}}</th>
                                                            <th></th>


                                                        </tr>
                                                        </thead>
                                                        <tbody class="langs-table">

														<?php
														try {



														?>
                                                        @if(is_array($custom_langs))

                                                            @foreach($custom_langs as $k => $v)
                                                                @include( 'admins.'.config('settings.admin').'.options.lang_item', compact('k','v'))
                                                            @endforeach
                                                        @endif
														<?php

														} catch ( Exception $e ) {

														}

														?>


                                                        </tbody>
                                                        <tfoot>

                                                        </tfoot>
                                                    </table>

                                                    <button data-tr='@include( 'admins.'.config('settings.admin').'.options.lang_item', [
                                                    'k' => '',
                                                    'v' => ''
                                                    ])'
                                                            class="add-new-language btn btn-info waves-effect waves-light">
                                                        <span><i class="ion-upload m-r-5"></i>{{__("admin.Add new Language")}}</span>

                                                    </button>
                                                </div>
                                            </div>


                                            <div class="form-group m-b-0">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success"><i
                                                                class="fa fa-check"></i>{{__("admin.Save changes")}}</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{--<div class="col-md-6">--}}
                            {{--<div class="">--}}
                            {{--<h3 class="box-title m-b-0">Reading Settings--}}
                            {{--</h3>--}}
                            {{--<br>--}}
                            {{--<div class="row">--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}

                            {{--<div class="form-group">--}}
                            {{--<fieldset>--}}
                            {{--<legend class="screen-reader-text">--}}
                            {{--<span>{{__("admin.Your homepage displays")}}</span></legend>--}}
                            {{--<p><label>--}}
                            {{--<input name="show_on_front" type="radio" value="posts"--}}
                            {{--class="tog">--}}
                            {{--Your latest posts </label>--}}
                            {{--</p>--}}
                            {{--<p><label>--}}
                            {{--<input name="show_on_front" type="radio" value="page"--}}
                            {{--class="tog" checked="checked">--}}
                            {{--A <a href="edit.php?post_type=page">{{__("admin.static page")}}</a> (select--}}
                            {{--below) </label>--}}
                            {{--</p>--}}
                            {{--<ul>--}}
                            {{--<li><label for="page_on_front">{{__("admin.Homepage: ")}}<select--}}
                            {{--name="page_on_front" id="page_on_front">--}}
                            {{--<option value="0">— Select —</option>--}}
                            {{--<option class="level-0" value="10199">About Us--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10147">{{__("admin.Blog")}}</option>--}}
                            {{--<option class="level-0" value="10190">Car Listing--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10265">{{__("admin.Cart")}}</option>--}}
                            {{--<option class="level-0" value="10268">Checkout--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10561">COMING SOON--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10210">Contact Us--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="1896">{{__("admin.FAQS")}}</option>--}}
                            {{--<option class="level-0" value="10517">Home 2--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10531">Home 3--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10537">Home 4--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10540">Home 5--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10383">Home 6--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10855">Home video--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10386"--}}
                            {{--selected="selected">index--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10503">{{__("admin.login")}}</option>--}}
                            {{--<option class="level-0" value="10337">My Account--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10696">One page--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="2">Sample Page--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10336">{{__("admin.Shop")}}</option>--}}
                            {{--<option class="level-0" value="10271">Shortcodes--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10544">Typography--}}
                            {{--</option>--}}
                            {{--</select>--}}
                            {{--</label></li>--}}
                            {{--<li><label for="page_for_posts">{{__("admin.Posts page: ")}}<select--}}
                            {{--name="page_for_posts" id="page_for_posts">--}}
                            {{--<option value="0">— Select —</option>--}}
                            {{--<option class="level-0" value="10199">About Us--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10147">{{__("admin.Blog")}}</option>--}}
                            {{--<option class="level-0" value="10190">Car Listing--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10265">{{__("admin.Cart")}}</option>--}}
                            {{--<option class="level-0" value="10268">Checkout--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10561">COMING SOON--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10210">Contact Us--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="1896">{{__("admin.FAQS")}}</option>--}}
                            {{--<option class="level-0" value="10517">Home 2--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10531">Home 3--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10537">Home 4--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10540">Home 5--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10383">Home 6--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10855">Home video--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10386">{{__("admin.index")}}</option>--}}
                            {{--<option class="level-0" value="10503">{{__("admin.login")}}</option>--}}
                            {{--<option class="level-0" value="10337">My Account--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10696">One page--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="2">Sample Page--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10336">{{__("admin.Shop")}}</option>--}}
                            {{--<option class="level-0" value="10271">Shortcodes--}}
                            {{--</option>--}}
                            {{--<option class="level-0" value="10544">Typography--}}
                            {{--</option>--}}
                            {{--</select>--}}
                            {{--</label></li>--}}
                            {{--</ul>--}}
                            {{--</fieldset>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="posts_per_page" class="col-sm-3 control-label">--}}
                            {{--Blog pages show at post</label>--}}
                            {{--<div class="col-sm-9">--}}
                            {{--<input type="number" value="" min="1" name="posts_per_page"--}}
                            {{--class="form-control"--}}
                            {{--id="posts_per_page">--}}

                            {{--</div>--}}
                            {{--</div>--}}


                            {{--<div class="form-group">--}}
                            {{--<label for="admin_email" class="col-sm-3 control-label">--}}
                            {{--Insert language code (only for multlanguge site)--}}
                            {{--</label>--}}
                            {{--<div class="col-sm-9">--}}
                            {{--<input type="email" class="form-control" id="admin_email"--}}
                            {{--placeholder="exp ru, en, es"></div>--}}
                            {{--</div>--}}


                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--</div>--}}
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>

<script>

    jQuery(document).ready(function ($) {


        $('.add-new-language').click(function (e) {
            e.preventDefault();
            $('.langs-table').append($(this).data('tr'));
        });


        $("body").on("click", ".btn-delete", function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    });

</script>