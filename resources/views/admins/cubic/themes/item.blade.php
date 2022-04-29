<div class="theme-item col-md-3 col-sm-6 col-xs-12 " data-alias="{{$theme['pathname'] ?? ''}}">


    <div @if(!isset($theme['activated'])) style="display: none;"
         @endif class="ribbon ribbon-bookmark ribbon-vertical-r ribbon-success"><i
                class="fa fa-heart"></i>
    </div>

    <div class="white-box ">

        <div class="product-img ">
            <img src="{!! $theme['screenshot'] ?? ''  !!}"
                 class="img-responsive"/>
        </div>
        <div class="product-text ">


            <div class="form-group ">
                <h3 class="box-title m-b-0">{{ $theme['name'] ?? '' }}</h3>
                <p class="text-muted db">{{ $theme['description'] ?? '' }}

                </p>

                <p class="theme-author">{{__('admin.By')}} {{ $theme['author'] ?? '' }}</p>
                <p class="author-url">{{ $theme['homepage'] ?? '' }}</p>
            </div>
            <div class="form-group ">
                <br>
                <a data-alias="{{$theme['pathname'] ?? ''}}"  href="javascript:void(0)"
                   class="text-inverse delete_theme btn btn-danger  pull-right" title=""
                   data-id="1"

                   data-toggle="tooltip" data-original-title=" {{__('admin.Delete theme')}}"><i
                            class="ti-trash"></i></a>


                <a  data-alias="{{$theme['pathname'] ?? ''}}"
                   @if(isset($theme['activated'])) style="display: none;" @endif
                   href="{{route('admin.themes.store')}}"
                   class="activate_theme text-inverse p-r-10 btn btn-info pull-right"
                   data-toggle="tooltip"
                   title="" data-original-title=" {{__('admin.Activate theme')}}"><i class="ti-brush"></i>{{__('admin.Activate')}}</a>

            </div>


        </div>
    </div>
</div>