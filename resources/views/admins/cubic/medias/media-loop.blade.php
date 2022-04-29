
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 media-item" style="padding-right: 1px;padding-left: 1px;" >

            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1" >
                    <img data-id="{{$media->id}}"
                            src="{{  the_image_url($media,'thumbnail-260x260')  }}">
                    <div class="el-overlay" style="min-height: 50px">
                        <ul class="el-info">
                            <li><a class="btn default btn-outline image-popup-vertical-fit"
                                   href="{{  the_image_url($media)  }}"><i
                                            class="icon-magnifier"></i></a></li>
                            <li>
                                <a data-id="{{$media->id}}" href="javascript:void(0)" class="delete_media btn default btn-outlinetext-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>


            </div>

        </div>
