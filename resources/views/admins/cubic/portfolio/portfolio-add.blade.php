<div class="container-fluid">
    <!-- /.row -->


    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{  (isset($portfolio->id)) ?  __('admin.Edit portfolio') :  __('admin.Add portfolio')}}

                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        <form method="post"
                              action="{{  (isset($portfolio->id)) ? route('admin.portfolio.update',['portfolios'=>$portfolio->id]) : route('admin.portfolio.store')  }}">

                            @if(isset($portfolio->id))
                                <input type="hidden" name="_method" value="PUT">

                            @endif

                            <div class="form-body">
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

                                <div class="col-md-9">
                                    <h3 class="box-title">{{__('admin.About portfolio')}}</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> {{__('admin.portfolio Name')}}</label>
                                                <input type="text" id="firstName" class="form-control"
                                                       name="title" placeholder="{{__('admin.portfolio Name')}}"

                                                       value="{{  old('title', isset($portfolio->title) ? $portfolio->title : '' )  }}"
                                                ></div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="">
                                                <label class="control-label"> {{__('admin.Permalink:')}}

                                                    @if(isset($portfolio->id))

                                                        <a class="" target="_blank"
                                                           href="{{ route('portfolio.show',['alias' => $portfolio->alias])}}">{{ route('admin.portfolio.show',['alias' => $portfolio->alias])}}</a>

                                                    @endif
                                                </label>

                                            </div>
                                            <input name="alias" type="text" id="alias" class="form-control"
                                                   placeholder=""
                                                   value="{{  old('alias', isset($portfolio->alias) ? $portfolio->alias : '' )  }}"

                                            ></div>


                                        <!--/span-->
                                    </div>

                                    <div class="form-group">
                                        <h3 class="box-title m-t-40"> {{__('admin.Portfolio Description')}}</h3>
                                        <div class="row">
                                            <div class="col-md-12 ">

                                                <div class="form-group  text-editor-full">
                                                    <textarea name="text" class="text form-control"
                                                              rows="4">{{  old('text', isset($portfolio->text) ? $portfolio->text : '' )  }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>




                                </div>
                                <!--->
                                <div class="col-md-3">

                                    <div class="clearfix ">
                                        <div class="form-actions m-t-40">
                                            <button type="submit" class="btn btn-block btn-success btn-lg"><i
                                                        class="fa fa-check"></i>

                                                @if(isset($portfolio->id) )

                                                    {{__('admin.update')}}
                                                @else

                                                    {{__('admin.save')}}
                                                @endif
                                            </button>

                                        </div>
                                        <br><br>
                                    </div>
                                    <div class="">

                                        <div class="">

                                            <div class="form-group  shadow-group ">
                                                <label class="control-label"><strong>  {{__('admin.Category')}}</strong></label>


                                                <div class="cat-group">
                                                    {!!  $category_list ?? '' !!}
                                                </div>

                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="scheduled_publication" class="control-label"><strong>
                                                        {{__('admin.Scheduled publication')}}

                                                    </strong> </label>
                                                <input id="scheduled_publication"
                                                       type="text"
                                                       name="published_at"
                                                       value="{{  isset($portfolio->published_at ) ? $portfolio->published_at->format('m/d/Y H:i') : '' }}"

                                                       class="form-control mydatepicker"
                                                       placeholder="mm/dd/yyyy">


                                            </div>
                                        </div>


                                        <div class="">
                                            <div class="form-group">
                                                <label class="control-label"><strong> {{__('admin.Status')}}</strong></label>
                                                <div class="radio-list">
                                                    <label class="radio-inline p-0">
                                                        <div class="radio radio-info">
                                                            <input {{  isset($portfolio->status ) ? checked($portfolio->status, 'published') : '' }} type="radio"
                                                                   name="status"
                                                                   id="radio1"
                                                                   value="published">
                                                            <label for="radio1">{{__('admin.Published')}}</label>
                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input {{   isset($portfolio->status ) ?  checked($portfolio->status, 'draft') : '' }}
                                                                   type="radio" name="status" id="radio2"
                                                                   value="draft">
                                                            <label for="radio2">{{__('admin.Draft')}}</label>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="">
                                        <div class="">
                                            <div class="form-group">
                                                <label><strong> {{__('admin.Meta Description')}}</strong></label>
                                                <input type="text"
                                                       value="{{  old('meta_desc', isset($portfolio->meta_desc) ? $portfolio->meta_desc : '' )  }}"
                                                       name="meta_desc" class="form-control"></div>
                                        </div>
                                        <!--/span-->
                                        <div class="=">
                                            <div class="form-group">
                                                <label><strong> {{__('admin.Meta Keyword')}} </strong</label>
                                                <input
                                                        value="{{  old('keywords', isset($portfolio->keywords) ? $portfolio->keywords : '' )  }}"

                                                        type="text" name="keywords" class="form-control"></div>
                                        </div>
                                        <!--/span-->
                                        <div class="">
                                            <h3 class="box-title m-t-20">
                                                <strong>{{__('admin.Featured Image')}} </strong></h3>
                                            <div class="product-img">

                                                @if(isset($portfolio->img))
                                                    <img class="img-responsive"
                                                         src="{{ the_image_url($portfolio->img,'thumbnail-260x260') }}">
                                                    <input type="hidden" name="img" value="{{$portfolio->img}}"
                                                           class="featured_image_id">
                                                @else
                                                    <img class="img-responsive"
                                                         src="{{ asset(config('settings.admin')) }}/plugins/images/placeholder.png">
                                                    <input type="hidden" name="img" value="" class="featured_image_id">
                                                @endif


                                                <br>
                                                <br>
                                                <div
                                                        class="set_media fileupload btn btn-info waves-effect waves-light">
                                                    <span><i class="ion-upload m-r-5"></i> {{__('admin.Set featured Image')}} </span>
                                                    {{--<input type="file" class="upload">--}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <h3 class="box-title">{{__('admin.Product gallery images')}}</h3>


                                            <div class="product-gallery-images">


                                                @if( isset($meta['gallery_media'])  )

				                                    <?php  $gallery = explode( ',', $meta['gallery_media'] ); ?>
                                                    @foreach($gallery as $item)
                                                        <div data-id='{{$item}}' class="product-img   gallery-image">
                                                            <a href="javascript:void(0)" class="text-danger delete"
                                                               title=""
                                                               data-id="3" data-toggle="tooltip"
                                                               data-original-title="Delete">
                                                                <i class="fa fa-times-circle"></i></a>
                                                            <img class="img-responsive"
                                                                 src="{{ the_image_url($item,'thumbnail-70x70') }}">
                                                        </div>

                                                    @endforeach


                                                @endif

                                            </div>
                                            <input type="hidden"
                                                   value="{{ isset($meta['gallery_media']) ? $meta['gallery_media'] : ''  }}"
                                                   id="gallery-media" name="gallery_media">
                                            <div class="product-img">
                                                <br>
                                                <br>
                                                <div class="clearfix"></div>
                                                <div class="set_media_gallery  btn btn-info waves-effect waves-light  ">

                                                    <span><i class="ion-upload m-r-5"></i> {{__('admin.Set gallery images')}} </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <!--/row-->


                                <!--/row-->

                                <hr>
                            </div>
                            {{ csrf_field()  }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<style></style>
<?php  $tags_arr = [];
$tags_arr = [];
if ( isset( $tags ) ) {
	foreach ( $tags as $tag ) {
		$tags_arr[] = '"' . $tag->title . '"';
	}
}
$obj = implode( ',', $tags_arr );
?>
<script>
    // $(document).ready(function () {


    jQuery(document).ready(function ($) {

        var data = [{!!  $obj !!}];

        var states = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: data
        });
        states.initialize();

        $(".portfolio-tag").tagsinput({
            allowDuplicates: true,
            typeaheadjs: {
                name: "states",
                source: states.ttAdapter()
            },
            freeInput: true
        });

        $('.portfolio-tag').tagsinput('refresh');


        ///////////////////////////////

        $('.cat-group').slimScroll({
            height: '250px'
        });
        $('#scheduled_publication').datetimepicker({
            format: "MM/DD/YYYY H:mm",
        });


        /*
         upload image
         */
        $('.set_media').click(function (e) {
            mediaLibrary.open();
            mediaLibrary.event = 'product-img';
            var button = $(this);
            $('#mediaLibrary-modal').on('mediaLibrary.product-img', function (e, img_id, img_src) {
                var img_f = button.closest('.product-img');
                img_f.find('img').attr('src', img_src);
                img_f.find('input').val(img_id);

            });
        });


        $('.set_media_gallery').click(function (e) {
            mediaLibrary.open();
            mediaLibrary.event = 'product-gallery-img';

        });
        var product_gallery = [];
        if ($('#gallery-media').val().length > 0) {
            product_gallery = $('#gallery-media').val().split(',');
        }
        $('#mediaLibrary-modal').on('mediaLibrary.product-gallery-img', function (e, img_id, img_src) {


            if ($('.gallery-image img[src="' + img_src + '"]').length === 0) {
                $('.product-gallery-images').append("<div data-id='" + img_id + "' class=\"product-img   gallery-image\">\n" +
                    "                                                    <a href=\"javascript:void(0)\" class=\"text-danger delete\" title=\"\" data-id=\"3\" data-toggle=\"tooltip\" data-original-title=\"Delete\">\n" +
                    "                                                        <i class=\"fa fa-times-circle\"></i></a>\n" +
                    "                                                    <img class=\"img-responsive\" src=\"" + img_src + "\">\n" +
                    "                                                </div>");

            }

            product_gallery.push(img_id);
            $('#gallery-media').val(product_gallery.join(','));

        });


        $("body").on("click", ".gallery-image .delete", function (e) {
            e.preventDefault();

            id = $(this).data('id');
            var idx = product_gallery.findIndex(function (p) {
                return p === id;
            });
            product_gallery.splice(idx, 1);
            $('#gallery-media').val(product_gallery.join(','));

            $(this).closest('.product-img').fadeOut(500).remove();


        });


        ////////////////////////////////////////////////

    });


    tinymce.init({
        selector: 'textarea.text',
        height: 500,
        //    theme: 'modern',
        plugins: 'paste print preview   searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        images_upload_url: 'portfolioAcceptor.php',
        /*   menubar: "edit",'*/
        toolbar: "paste",
        paste_data_images: true,
        images_upload_handler: function (blobInfo, success, failure) {
            var formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.blob().name);
            formData.append('tiny_uploader', '1');

            $.ajax({
                url: '{{route('admin.media.store')}}',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                type: 'portfolio',
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    success(obj.location);
                    console.log(obj.location);

                }
            });
        },


    });


</script>