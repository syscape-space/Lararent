<div class="pb-sidebar  sidebar_opened">
    <h3 class="tab-title tab-title-1">{{__('Add Layouts ')}}</h3>

    <button type="button" id="pb-save" class="btn btn-success pull-right save-customize ">
        <i class="fa fa-plus"></i>
        {{__('Save')}}
    </button>

    <br><br>

    <div class="clearfix"></div>


    <div class="modules-divst divst-elements">


        @if($modules ?? false && $modules)
            @foreach($modules as $k=> $module)
                <div data-module-name="{{$k}}" ondrop="true" template="skin-1.php"
                     data-filter="Cover Media 1"
                     class="module-item pb-module-item
" unselectable="on"
                >
                    <span class="mw_module_hold">
                                                <span class="mw_module_image">
                            <span class="mw_module_image_holder">
                                <img alt="{{$module['name']}}" title="{{$module['name']}}" class="module_draggable"
                                     data-module-name-enc="layout_201811051654241" data-module-name="layouts"
                                     ondrop="true"
                                     src="{{$module['img'] ?? ''}}"
                                     data-src="">
                            </span>
                        </span>
                        <span class="module_name" alt="">{{$module['name']}}</span>
                    </span>
                </div>
            @endforeach
        @endif


    </div>
</div>

<div id="pb-image-edit-nav">
    <span class="mw-ui-btn mw-ui-btn-medium mw-ui-btn-invert mw-ui-btn-icon image_change tip"
          data-toggle="tooltip" title="Some text">
      <i class="fa fa-picture-o" aria-hidden="true"></i>

    </span>
</div>