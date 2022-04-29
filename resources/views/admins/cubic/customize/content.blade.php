<div class="col-md-3  col-sm-4 custumize-sidebar " style="padding: 0px 0px 0px 5px;
 position: relative; z-index: 3;  height: 100vh;">


    <style>
        .panel .panel-body {
            padding: 20px;
        }
    </style>
    <div class="">


        <div class="panel-heading white-box">
            <div class="form-group">
                <a href="{{$url ?? back()->getTargetUrl()}}" type="button" class="btn btn-danger pull-left">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
					<?php  echo __('admin.Сancel'); ?>

                </a>


                <button

                        type="button" id="btnAdd"
                        class="btn btn-success pull-right save-customize ">
                    <i class="fa fa-plus"></i>
					<?php  echo __('admin.Save'); ?>

                </button>
                <div class="save-preloader pull-right" style="padding-right: 20px ;">
                    <div class="cssload-speeding-wheel"></div>
                </div>

            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <h1 class="panel-title " style="font-size: 150%">
                    {{__('admin.You are customizing') }}
                    <strong>{{ session( 'lr_active_theme_slug' ) }}  {{__('admin.Theme')}}</strong></h1>
            </div>

        </div>

        <div class="custpreloader">

        </div>
        <form id="customize_accordion" class="panel-group">

            @foreach($panels as $k => $panel)

                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="collapsed" data-parent="#customize_accordion"
                               href="#panel_{{$k}}">{{ $panel['title'] ?? '' }}</a>
                        </h4>
                    </div>
                    <div id="panel_{{$k}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>{{ $panel['description'] ?? '' }}</p>
                            @if(isset($panel['controls']))
                                @foreach($panel['controls'] as $controller)
                                    {{	$controller->renderOutput()}}
                                    <hr>
                                @endforeach
                            @endif
                            @if($panel['section'] ?? false)

                                <div class="row">
                                    <div id="customize_accordion_{{$k}}" class="panel-group">
                                        @foreach($panel['section'] as $p => $p_v)

                                            <div class="panel panel-inverse">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" class="collapsed"
                                                           data-parent="#customize_accordion_{{$k}}"
                                                           href="#panel_{{$k}}_sub_{{$p}}">{{ $p_v['title'] ?? '' }}</a>
                                                    </h4>
                                                </div>
                                                <div id="panel_{{$k}}_sub_{{$p}}" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <p>{{ $p_v['description'] ?? '' }}</p>

                                                        @if($panel['section'] ?? false)
                                                            <div id="customize_accordion_{{$k}}" class="panel-group">

																<?php if ( isset( $p_v['controller'] ) ) {
																	foreach ( $p_v['controller'] as $controller ) {
																		$controller->renderOutput();
																		?>

                                                            <?php
																	}
																}?>
                                                            </div>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach


        </form>

    </div>
</div>

<div class="col-md-9  col-sm-8" style="padding: 0;">
    <div class="preloder-c">
        <div class="cssload-speeding-wheel"></div>
    </div>


    <iframe id="preview_iframe" style="height: 100vh; width: 100%;
        position: absolute; padding: 0; border: none" src="<?php
	if ( strpos( $url, '?' ) !== false ) {
		echo $url . '&lr_preview_customize=1';
	} else {
		echo $url . '?lr_preview_customize=1';
	}
	?>">

    </iframe>
</div>


<script>

    jQuery(document).ready(function ($) {


        //  mediaLibrary.open();

        /// imgee
        $('.save-preloader').hide();


        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        $('#btnAdd').prop('disabled', true);


        /*
         hide preoleader when iframe is loaded
        */
        $('#preview_iframe').load(function () {
            $('.preloder-c').hide();
        });
        /*
        Save options
         */
        $("body").on("click", ".save-customize", function () {
            $('.save-preloader').show();

            var this_b = $(this);
            this_b.prop('disabled', true);
            $.ajax({
                url: '{{route('admin.customize.index')}}',
                data: $('#customize_accordion').serialize(),
                type: 'post', // replaced from put
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (r) {
                    console.log(r);
                    $('.save-preloader').hide();
                    this_b.prop('disabled', false)

                },
                error: function (msg) {
                    $('.save-preloader').hide();
                    this_b.prop('disabled', false)
                }
            });
        });

        var timeout = null;


        /*
        Loader priviews monde on change
         */


        $('#customize_accordion').on('keyup change paste', 'input, select, textarea', function () {



            // Clear the timeout if it has already been set.
            // This will prevent the previous task from executing
            // if it has been less than <MILLISECONDS>
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                $('#btnAdd').prop('disabled', false);
                //   $('#preview_iframe').css('opacity','0.5');

                $('.preloder-c').show();
                $.ajax({
                    url: '{{route('admin.customize.index')}}',
                    data: $('#customize_accordion').serialize() + "&preview=1",
                    type: 'post', // replaced from put
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (r) {
                        console.log(r);
                        $('#preview_iframe').attr('src', function (i, val) {
                            return val;
                        });
                        $('#preview_iframe').load(function () {
                            //  $('#preview_iframe').css('opacity','1');

                            $('.preloder-c').hide();

                        });

                        // $('#preview_iframe').show();
                    },
                    error: function (msg) {
                        $('#preview_iframe').attr('src', function (i, val) {
                            return val;
                        });
                        $('#preview_iframe').load(function () {
                            //  $('#preview_iframe').css('opacity','1');
                            $('.preloder-c').hide();
                        });

                    }
                });
            }, 500);


        });


        /*
        media images
         */

        $("body").on("click", ".media-library-select", function () {
            mediaLibrary.open();
            var button = $(this);
            $('#mediaLibrary-modal').on('mediaLibrary.stateChange', function (e, img_id, img_src) {
                button.closest('.form-group').find('img').remove();
                button.closest('.form-group').find('.placeholder').hide().after("  <img class=\"img-responsive\t\" src='" + img_src +
                    "' alt=\"\">");

                button.closest('.form-group').find('.featured_image_id').val(img_id);
                $('.media-library-delete').removeClass('dn').show();
                $('#customize_accordion input').trigger("change");
            });
        });
        $("body").on("click", ".media-library-delete", function () {

            var button = $(this);
            button.closest('.form-group').find('.placeholder').show().removeClass('dn');
            button.closest('.form-group').find('img').remove();
            button.closest('.form-group').find('.featured_image_id').val('');
            button.hide();
            button.closest('.form-group').find('.placeholder').show();
            $('#customize_accordion input').trigger("change");

        });


        $(".colorpicker").asColorPicker();

        var timeout_color_piker = null;
        /*
        Color picker
        */
        $('.colorpicker').on('asColorPicker::change', function (e) {
            // on value change
            clearTimeout(timeout_color_piker);
            timeout_color_piker = setTimeout(function () {
                $('#customize_accordion input').trigger("change");
            }, 500)
        });
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });

    });
</script>
