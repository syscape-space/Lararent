var mediaLibrary;
(function ($) {
    var $document = $(document);


    mediaLibrary = {

        img_src: "",
        img_id: "",
        event: "stateChange",
        opened: false,

        init: function (event) {
            this.event = event || this.event;
            var img_src = '';
            var img_id = '';
            // alert(medialibrary_obj.ajaxUrl);
            //  $('#mediaLibrary-modal').modal('show');
            $("body").on("click", "#mediaLibrary-modal .el-overlay-1", function () {
                //    alert(3);
                $(this).addClass('selected');
                $('.media-item').removeClass('selected');


                $(this).closest('.media-item').addClass('selected');

                mediaLibrary.img_src = $(this).closest('.media-item').find('img').attr('src');
                mediaLibrary.img_id = $(this).closest('.media-item').find('img').data('id');


            });

            $("body").on("click", "#mediaLibrary-modal .insert_img_new", function (e) {
                e.preventDefault();
                e.stopPropagation();

                console.log(mediaLibrary.img_src);


                $('#mediaLibrary-modal').trigger('mediaLibrary.' + mediaLibrary.event, [mediaLibrary.img_id, mediaLibrary.img_src]);

            });
        }
        ,
        open: function () {

                var myDropzone1;
                $('#mediaLibrary-modal').modal('show');

                $.ajax({
                    url: medialibrary_obj.ajaxUrl,
                    type: 'post', // replaced from put
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (r) {
                        $('#mediaLibrary-modal .modal-body').html(r);

                        /**
                         * Delete media
                         */
                        start_popup();

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


                        /**
                         * dropzone start
                         */

                        jQuery("#media_uploader").dropzone({
                            dictDefaultMessage: "Drop files here to upload",
                            init: function () {
                                myDropzone1 = this;


                                jQuery.ajax({
                                    url: medialibrary_obj.store,
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: 'POST',
                                    data: {somefield: "Some field value"},
                                    success: function (data) {

                                    }
                                });

                                myDropzone1.on("success", function (file) {
                                    var new_item = $(file.xhr.responseText).hide();
                                    $('.media_container').prepend(new_item);
                                    new_item.show('normal');
                                    start_popup();

                                });

                                myDropzone1.on("addedfile", function (file) {
                                    $('#media_uploader').prepend($(file.previewElement));
                                });

                                var page = 1;
                                $('#mediaLibrary-modal .modal-body').scroll(function () {

                                    console.log('sdfsdf');
                                    if (($(window).scrollTop() + $(window).height() + 800) >= $(document).height()) {
                                        page++;

                                        loadMoreData(page);
                                    } else {

                                        console.log($(window).scrollTop() + $(window).height(), $(document).height());
                                    }
                                });
                            },
                        });


                    },
                    error: function (msg) {

                    }
                });

        }

    }
    ;

    $document.ready(function () {
        mediaLibrary.init();



        //    mediaLibrary.open();
    });




})(jQuery);

function start_popup() {

    $('.image-popup-vertical-fit').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }

    });
}

function loadMoreData(page) {
    $.ajax(
        {
            url: medialibrary_obj.store + '?page=' + page,
            type: "get",
            data: 'ajax_load_page=1',
            beforeSend: function () {
                $('.ajax-load').show();
            }
        })
        .done(function (data) {

            $('.ajax-load').hide();
            $('.media_container').append(data);
            start_popup();

        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            // alert('server not responding...');
        });
}