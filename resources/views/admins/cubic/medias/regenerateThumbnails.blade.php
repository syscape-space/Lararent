<div class="container-fluid">
    <div class="row">


        <div class="col-lg-12 p-r-40">
            <h2 class="box-title">
                {{__('admin.Regenerate Thumbnails')}}

                </h2>
            <p>{{__('admin.Regenerate-description')}}
               </p>


            <h3 class="title">  {{__('admin.Thumbnail Sizes')}}</h3>
            <p>{{__('admin.These are all of the thumbnail sizes that are currently registered:')}}</p>

            <ul class="list-group">
                @if($thumbnail_sizes ?? false)
                    @foreach($thumbnail_sizes as $k => $thumbnail_size)
                        <li class="list-group-item"><strong>{{$k}}:</strong> {{$thumbnail_size['width']}}
                            ×{{$thumbnail_size['height']}}
                            {{__('admin.pixels (cropped to fit)')}}

                        </li>


                    @endforeach

                @endif
            </ul>


            <div class="form-group">
                <button class="btn  btn-primary btn-lg regenerate-all">

                    {{__('admin.Regenerate Thumbnails For All Attachments',['count' =>  $media ?? ''])}}
                </button>
            </div>

            <div class="form-group">
                <div class="regenerate-progress progress progress-lg dn ">
                    <div class="progress-bar progress-bar-success" style="width: 0%;" role="progressbar">0%</div>
                </div>
            </div>


            <div class="log-panel">
                <h3 class="title">{{__('admin.Regeneration log')}}</h3>
                <div class="log">
                    <ol>

                    </ol>
                </div>
            </div>


        </div>

        <script>
            jQuery(document).ready(function ($) {
                $("body").on("click", ".regenerate-all", function () {
                    // import demo
                    var rt_count = 1;
                    var this_button = $(this);
                    var progressLabel = jQuery(".progress-bar");
                    this_button.prop('disabled', true);

                    $.ajax(
                        {
                            url: '{{route('admin.regenerateThumbnails.index')}}',
                            type: "get",
                            data: 'ajax_load_page=1',
                            beforeSend: function () {
                                $('.regenerate-progress').show();
                            }
                        })
                        .done(function (data) {

                            var progress = 0;
                            $('.regenerate-progress').show().removeClass('dn');
                            //    percent = 100 / data.length;
                            var rt_total = data.length;


                            jQuery.each(data, function (i, item) {

                                $.ajax(
                                    {
                                        url: '{{route('admin.regenerateThumbnails.index')}}/' + item.id,
                                        type: "PATCH",
                                        data: 'item=' + item.id,
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        beforeSend: function () {
                                            $('.regenerate-progress').show();
                                        }
                                    })
                                    .done(function (res) {

                                        console.log(res.message);


                                        percent = Math.round((rt_count / rt_total) * 1000) / 10 + "%";
                                        progressLabel.text(percent);
                                        $('.regenerate-progress .progress-bar').css('width', percent);
                                        $('.log-panel').removeClass('dn');
                                        $('.log-panel ol').append('<li>' + res.message + '</li>');

                                        rt_count++;
                                        console.log(  rt_count, data.length );
                                      if(  rt_count  > data.length){
                                          $('.regenerate-all').prop('disabled', false);
                                      }

                                    })
                                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                                    });


                            });



                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError) {
                            // alert('server not responding...');
                        });

                });


            });
        </script>
    </div>
</div>