@if( $plugin ?? false)
    <tr data-alias="{{$plugin['pathname'] ?? ''}}"  @if($plugin['activated'] ?? false) class="success" @endif >
        <td>

            <input type="checkbox" class="check check-plugins" name="checked[]"
                   value="{{$plugin['pathname'] ?? ''}}"
                   data-checkbox="icheckbox_square-green">

        </td>
        <td class="col-md-3 ">

            <div class="form-group"
                 style="position: relative;     padding: 0px 5px 15px 50px;">


                <div @if(!($plugin['activated'] ?? false))  style="display: none;"
                     @endif class="ribbon ribbon-bookmark ribbon-vertical-l ribbon-success">
                    <i class="fa fa-check-circle"></i></div>


                <strong>
                    {{ $plugin['name'] ?? '' }}
                </strong>
            </div>


        </td>
        <td class="col-md-6">

            {{ $plugin['description'] ?? '' }}

            <div class="inactive second plugin-version-author-uri">
                {{__('admin.Version')}}       {{ $plugin['version'] ?? '' }} |   {{__('admin.By')}}  <a
                        href="{{ $plugin['author-url'] ?? '' }}">{{$plugin['author'] ?? ''}}</a>
                |
                <a
                        href="{{ $plugin['homepage'] ?? '' }}"
                        class="thickbox open-plugin-details-modal"
                        aria-label="More information about Hello Dolly"
                        data-title="Hello Dolly">{{__('admin.View details')}}</a></div>
        </td>
        <td class="col-md-3">
            <div class="col-md-12">


                <button @if(($plugin['activated'] ?? false))  style="display: none;"
                        @endif   data-alias="{{$plugin['pathname'] ?? ''}}"
                        class="text-inverse p-r-10 btn-outline btn-info activated_plugin"
                        data-toggle="tooltip" title=""
                        data-original-title="{{__('admin.Activate')}}   {{ $plugin['name'] ?? '' }}">
                    <i class="fa fa-plug fa-fw"></i>
                    {{__('admin.Activate')}}
                </button>

                <button @if(!($plugin['activated'] ?? false))  style="display: none;"
                        @endif
                        data-alias="{{$plugin['pathname'] ?? ''}}"
                        class="text-inverse deactivate_plugin btn-outline  btn-warning"
                        title=""
                        data-id="3" data-toggle="tooltip"
                        data-original-title="{{__('admin.Deactivate')}}   {{ $plugin['name'] ?? '' }}">
                    <i class="ti-trash"></i>

                    {{__('admin.Deactivate')}}
                </button>
                <button @if(($plugin['activated'] ?? false))  style="display: none;"
                        @endif   data-alias="{{$plugin['pathname'] ?? ''}}"
                        class="text-inverse delete_plugin btn-outline btn-danger"
                        title=""
                        data-id="3" data-toggle="tooltip"
                        data-original-title=" {{__('admin.Delete')}}  {{ $plugin['name'] ?? '' }}">
                    <i class="ti-trash"></i>
                    {{__('admin.Delete')}}

                </button>
            </div>
        </td>


    </tr>
@endif