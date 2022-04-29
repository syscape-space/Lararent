
@foreach($RegisteredWidgets as $v)
<?php  $w = new $v();

?>

<div id="__i__" data-id="" class="widget   panel panel-info">
    <div class="widget-top panel-heading">
        <div class="pull-right">

        </div>
        <div class="widget-title-action pull-right">
            <a class=" widget-action hide-if-no-js button-link-delete widget-control-remove" aria-expanded="false">
                <i class="ti-marker-alt"></i>
            </a>

        </div>
        <div class="widget-title ui-draggable-handle ">{{$w->name}}<span
                    class="in-widget-title"></span>

        </div>
    </div>

    <div class="widget-inside panel-wrapper collapse ">
        <div class="panel-body">
            {{--{!! $w->form(array('number' => 1)) !!}--}}


            <form method="post" action="#" class="widget-form">
                <div class="widget-content">

                    {!! $w->form_callback() !!}

                </div>
                <input type="hidden" name="widget-id" class="widget-id"
                       value="{{$w->id_base}}-__i__">
                <input type="hidden" name="id_base" class="id_base"
                       value="{{$w->id_base}}">
                <input type="hidden" name="name" class="name"
                       value="{{$w->name}}">
                <input type="hidden" name="widget-width" class="widget-width" value="250">
                <input type="hidden" name="widget-height" class="widget-height" value="200">
                <input type="hidden" name="widget_number" class="widget_number" value="2">
                <input type="hidden" name="multi_number" class="multi_number" value="1">
                <input type="hidden" name="add_new" class="add_new" value="multi">
                <input type="hidden" name="callback"  value="{{$v}}">


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
                                   value="Save">
                        </i>
                    </div>
                    <br class="clear">
                </div>
            </form>
        </div>
    </div>

    <div class="widget-description">
      {{ $w->widget_options['description'] ?? '' }}
    </div>
</div>

    <style>
        #widget-list .widget-action  {
            display: none;
        }
    </style>
@endforeach
