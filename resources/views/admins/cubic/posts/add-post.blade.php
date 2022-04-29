<div class="container-fluid">
    <!-- /.row -->


    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{  (isset($post->id)) ?  __('admin.Edit post') :  __('admin.Add post')}}

                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">

                        <form method="post"
                              action="{{  (isset($post->id)) ? route('admin.posts.update',['posts'=>$post->id]) : route('admin.posts.store')  }}">

                            @if(isset($post->id))
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
                                    <h3 class="box-title">{{__('admin.About Post')}}</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> {{__('admin.Post Name')}}</label>
                                                <input type="text" id="firstName" class="form-control"
                                                       name="title" placeholder="{{__('admin.Post Name')}}"

                                                       value="{{  old('title', isset($post->title) ? $post->title : '' )  }}"
                                                ></div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="">
                                                <label class="control-label"> {{__('admin.Permalink:')}}

                                                    @if(isset($post->id))

                                                        <a class="" target="_blank"
                                                           href="{{ route('posts.show',['alias' => $post->alias])}}">{{ route('posts.show',['alias' => $post->alias])}}</a>

                                                    @endif
                                                </label>

                                            </div>
                                            <input name="alias" type="text" id="alias" class="form-control"
                                                   placeholder=""
                                                   value="{{  old('alias', isset($post->alias) ? $post->alias : '' )  }}"

                                            ></div>


                                        <!--/span-->
                                    </div>
                                    <div class="form-group">
                                        <h3 class="box-title m-t-40"> {{__('admin.Post Short Description')}}</h3>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea name="desc" class="desc form-control"
                                                              rows="4">{{  old('desc', isset($post->desc) ? $post->desc : '' )  }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <h3 class="box-title m-t-40"> {{__('admin.Post Description')}}</h3>
                                        <div class="row">
                                            <div class="col-md-12 ">

                                                <div class="form-group  text-editor-full">
                                                    <textarea name="text" class="text form-control"
                                                              rows="4">{{  old('text', isset($post->text) ? $post->text : '' )  }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <h3 class="box-title m-t-40">{{__('admin.Add tags')}}</h3>

                                    <div class="tags-default">
                                        <input name="tags" style="width: 100%" class="post-tag form-grup" type="text"
                                               value="{!! $attached_tag ?? '' !!}"
                                               placeholder="{{__('admin.Add tags')}}"/>
                                    </div>


                                </div>
                                <!--->
                                <div class="col-md-3">

                                    <div class="clearfix ">
                                        <div class="form-actions m-t-40">
                                            <button type="submit" class="btn btn-block btn-success btn-lg"><i
                                                        class="fa fa-check"></i>

                                                @if(isset($post->id) )

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
                                                <label class="control-label"><strong>  {{__('admin.Select Category')}}</strong></label>


                                                @if($category_list == '<ul class="category-group icheck-list"></ul>')

                                                    <a href="{{route('admin.categories.index')}}">{{__('admin.Add New Category')}}</a>
                                                @else
                                                    <div class="cat-group">
                                                        {!!  $category_list !!}
                                                    </div>
                                                @endif


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
                                                       value="{{  isset($post->published_at ) ? $post->published_at->format('m/d/Y H:i') : '' }}"

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
                                                            <input {{  isset($post->status ) ? checked($post->status, 'published') : '' }} type="radio"
                                                                   name="status"
                                                                   id="radio1"
                                                                   value="published">
                                                            <label for="radio1">{{__('admin.Published')}}</label>
                                                        </div>
                                                    </label>
                                                    <label class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input {{   isset($post->status ) ?  checked($post->status, 'draft') : '' }}
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
                                                       value="{{  old('meta_desc', isset($post->meta_desc) ? $post->meta_desc : '' )  }}"
                                                       name="meta_desc" class="form-control"></div>
                                        </div>
                                        <!--/span-->
                                        <div class="=">
                                            <div class="form-group">
                                                <label><strong> {{__('admin.Meta Keyword')}} </strong</label>
                                                <input
                                                        value="{{  old('keywords', isset($post->keywords) ? $post->keywords : '' )  }}"

                                                        type="text" name="keywords" class="form-control"></div>
                                        </div>
                                        <!--/span-->
                                        <div class="">
                                            <h3 class="box-title m-t-20">
                                                <strong>{{__('admin.Featured Image')}} </strong></h3>
                                            <div class="product-img">

                                                @if(isset($post->img))
                                                    <img class="img-responsive"
                                                         src="{{ the_image_url($post->img,'thumbnail-260x260') }}">
                                                    <input type="hidden" name="img" value="{{$post->img}}"
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

        $(".post-tag").tagsinput({
            allowDuplicates: true,
            typeaheadjs: {
                name: "states",
                source: states.ttAdapter()
            },
            freeInput: true
        });

        $('.post-tag').tagsinput('refresh');


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
            var button = $(this);
            $('#mediaLibrary-modal').on('mediaLibrary.stateChange', function (e, img_id, img_src) {
                var img_f = button.closest('.product-img');
                img_f.find('img').attr('src', img_src);
                img_f.find('input').val(img_id);
            });
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
        images_upload_url: 'postAcceptor.php',
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
                type: 'POST',
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    success(obj.location);
                    console.log(obj.location);

                }
            });
        },


    });


</script>