

<div id="wpwrap" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__('admin.Widgets')}}</div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div id="available-widgets" class="white-box all-widgets">
                        <h3 class="box-title">{{__('admin.Available Widgets')}}</h3>
                        <small>{{__('admin.widgets_description')}}</small>
                        <!-- sample modal content -->
                        <div id="widget-list">


                            {!! $registeredWidgets  !!}



                        </div>
                        <!-- /.modal -->
                    </div>


                </div>
                <div class="col-md-8">

                    <div class="row">

                        @foreach ($sidebars as $k => $v)


                            <div class="col-md-6  ">


                                <div class="panel panel-info">
                                    <div class="panel-heading">{{$v['name']}}

                                        <div class="pull-right">
                                            <div  style="display: none;" class="cssload-speeding-wheel {{$v['id'] ?? ''}} pull-left  "></div>
                                            <a href="#"
                                               data-perform="panel-collapse"><i class="ti-minus"></i></a>

                                        </div>
                                    </div>
									<?php

									$w_s = $widgets->sortBy( 'position' )->where( 'sidebar', $v['id'] );


									?>
                                    <div id="{{$v['id']}}"
                                         class="widgets-holder-wrap closed panel-wrapper collapse in rentit_sidebar widgets-sortables white-box  "
                                         aria-expanded="true">
                                        @if(isset($w_s))
                                            @foreach($w_s as $widget)

												<?php  $content = unserialize( $widget->output );



												?>



                                                <div class="widget   panel panel-info"
                                                     {{--id="{{$content['widget-id']}}_{{$content['multi_number']}}"--}}
                                                     id="{{$widget->id}}"
                                                     data-id="{{$widget->id}}"

                                                >
                                                    <div class="widget-top panel-heading">
                                                        <div class="pull-right">

                                                        </div>
                                                        <div class="widget-title-action pull-right">
                                                            <a class=" widget-action hide-if-no-js"
                                                               aria-expanded="false">
                                                                <i class="ti-marker-alt"></i>
                                                            </a>


                                                        </div>
                                                        <div class="widget-title ui-draggable-handle ui-sortable-handle">
                                                            {{ $widget->name}}
															<?php


															//  var_dump( (($content['widget-'.$content['id_base']]))); ?></div>
                                                    </div>

                                                    <div class="widget-inside panel-wrapper collapse in"
                                                         aria-expanded="true" style="display: none;">
                                                        <div class="panel-body">

                                                            <form method="post">

                                                                <div class="widget-content">

																	<?php


																	if(class_exists($widget->callback)){
																	$w = new $widget->callback();


																	?>
                                                                        {!! $w->form_callback(['number' => $content['multi_number']],$widget->id,$widget->output) !!}

																	<?php  } ?>
                                                                </div>
																<?php // dump( $content); ?>
                                                                <input type="hidden" name="widget-id" class="widget-id"
                                                                       value="{{$content['widget-id']}}">
                                                                <input type="hidden" name="id_base" class="id_base"
                                                                       value="{{$content['id_base']}}">
                                                                <input type="hidden" name="widget-width"
                                                                       class="widget-width"
                                                                       value="{{$content['widget-width']}}">
                                                                <input type="hidden" name="widget-height"
                                                                       class="widget-height"
                                                                       value="{{$content['widget-height']}}">

                                                                <input type="hidden" name="widget_number"
                                                                       class="widget_number"
                                                                       value="{{$content['widget_number']}}">
                                                                <input type="hidden" name="multi_number"
                                                                       class="multi_number"
                                                                       value="{{$content['multi_number']}}">

                                                                <input type="hidden" name="add_new" class="add_new"
                                                                       value="{{$content['add_new']}}">

                                                                <input type="hidden" name="name" class="name"
                                                                       value="{{$widget->name}}">
                                                                <input type="hidden" name="callback" class="name"
                                                                       value="{{ $widget->callback ?? $widget->callback}}">


                                                                <div class="widget-control-actions">
                                                                    <div class="form-group">

                                                                        <button type="button"
                                                                                data-toggle="tooltip" title="" data-original-title="Delete"
                                                                                class="btn btn-danger btn-circle button-link-delete widget-control-remove">
                                                                            <i class="ti-close widget-control-remove"></i>
                                                                        </button>

                                                                        <button type="button"
                                                                                data-toggle="tooltip" title="" data-original-title="Done"
                                                                                class="btn btn-info btn-circle widget-control-close">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>

                                                                    </div>
                                                                        <div  style="display: none;"   class="cssload-speeding-wheel  pull-right  "></div>

                                                                    <div class="alignright">

                                                                        <i class="btn btn-success waves-effect waves-light
                                                                         button button-primary widget-control-save right waves-input-wrapper"
                                                                           style="">
                                                                            <input type="submit"
                                                                                           name="savewidget"
                                                                                           id="widget-{{$w->id_base}}-__i__-savewidget"
                                                                                           class="waves-button-input widget-control-save right"
                                                                                           value="Update">
                                                                        </i>


                                                                    </div>


                                                                    <br class="clear">
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>


                                                </div>




                                            @endforeach

                                        @endif


                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
    </div>


</div>
<style>
    .panel.widget-hover {
        border-color: #72777c;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .3);
    }

    .widget-placeholder {
        border: 1px dashed #b4b9be;
        margin: 0 auto 10px;
        height: 45px;
        width: 100%;
        box-sizing: border-box;
    }

    .widget-title {
        cursor: pointer;
    }
</style>

<!-------------------------------------------->

<script>
    var ajaxurl = '{{route('admin.widgets.store')}}';
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ url('/cubic/widgets.js') }} "></script>
