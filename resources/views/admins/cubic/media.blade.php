<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__('admin.Media')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">


                        <div class="row el-element-overlay m-b-20">
                            <div class="white-box">
                            <div class="col-md-12">
                                <div id="resss"></div>

                                    <h3 class="box-title m-b-0">{{__('admin.Drop images to upload')}}</h3>
                                    <p class="text-muted m-b-30"></p>
                                    <form id="media_uploader" class="dropzone"
                                          action="{{route('admin.media.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <div class="preview">

                                        <div class="fallback">
                                            <input name="file" type="file" multiple/></div>


                                        <div class="col-md-12 media_container">
                                           {!! $medias ?? '' !!}
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            @yield('right-sidebar')

        </div>
    </div>
</div>

<?php  $edit_places_id = 0; ?>


<style>


</style>

<script>
    $(document).ready(function () {


        /*
         ajax paginagion
         */
        var page = 1;

        $(window).scroll(function() {
            if(($(window).scrollTop() + $(window).height() + 800 ) >= $(document).height()) {
                page++;
                //alert(1);
                loadMoreData(page);
            } else {
                console.log($(window).scrollTop() + $(window).height()  , $(document).height());
            }
        });


        function loadMoreData(page){
            $.ajax(
                {
                    url: '{{route('admin.media.index')}}?page=' + page,
                    type: "get",
                    data: 'ajax_load_page=1',
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)                {

                    $('.ajax-load').hide();
                    $('.media_container').append(data);
                    start_popup();

                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                   // alert('server not responding...');
                });
        }





        /**
         *  Delete media
         * */
        $(".media_container").on("click", ".delete_media", function () {
            var this_v = $(this);
            var this_id = this_v.data('id');


            swal({
                title: "Media will be deleted permanently!",
                text: "Are you sure to proceed?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove Media!",
                cancelButtonText: "No, I am not sure!",
                // closeOnConfirm: false,
                // closeOnCancel: false
            }).then(function (isConfirm) {


                // alert(isConfirm);
                if (isConfirm.value) {

                    $.ajax({
                        url: medialibrary_obj.store + '/' + this_id,
                        type: 'delete', // replaced from put
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            $(this_v).closest('.media-item').remove();

                        },
                        error: function (msg) {
                            $('.preloader').hide();
                            console.log(msg.responseJSON.message);
                            swal({
                                title: "Error!",
                                text: msg.responseJSON.message,
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",

                            })
                        }
                    });



                }
                else {

                }

            });


        });



        var $ajax_url = '{{route('admin.media.store')}}';
        var city2_obj = {
            'delete': '1',
            'upload': '1'

        };


        var myDropzone1;
        jQuery("#media_uploader").dropzone({

            init: function () {
                myDropzone1 = this;

                jQuery.ajax({
                    url: $ajax_url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'gat',
                    data: {somefield: "Some field value", _token: '{{csrf_token()}}'},
                    success: function (data) {
                        //   console.log(data);
                        /* jQuery.each(data, function (key, value) {
                        var mockFile = {name: value.name, size: value.size, attachment_id: value.id};
                        myDropzone1.emit("addedfile", mockFile);
                        myDropzone1.createThumbnailFromUrl(mockFile, value.url);
                        myDropzone1.emit("complete", mockFile);
                        });*/
                    }
                });
            },
        });

        // myDropzone1.on("queuecomplete", function (file) {
        //     alert("All files have uploaded ");
        // });


        myDropzone1.on("success", function (file) {
            var new_item = $(file.xhr.responseText).hide();
            $('.media_container').prepend(new_item);
            new_item.show('normal');
            start_popup();

        });


        myDropzone1.on("addedfile", function (file) {
            $('#media_uploader').prepend($(file.previewElement));
        });


        function  start_popup() {
            $('.image-popup-vertical-fit').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }

            });
        }





    });


</script>