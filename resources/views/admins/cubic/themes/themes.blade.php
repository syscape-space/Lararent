<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">


            <h2 class="box-title"><b>
                    {{ __('admin.Themes') }}
                </b></h2>
            <form id="media_uploader" class="dropzone col-md-12 form-group"
                  action="{{route('admin.themes.store')}}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="preview">

                    <div class="fallback">
                        <input name="file" type="file" multiple/></div>

                    <div class="dz-message" data-dz-message><span>
                                       {{ __('admin.Drop zip Theme file here to upload') }}
                                            </span>
                    </div>


                </div>
            </form>
            <div class="clerfix"></div>
            <div class="row theme-box">


                @if(isset($themes) && is_array($themes))

                    @foreach($themes as $theme)
                        @include( 'admins.'.config('settings.admin').'.themes.item', ['theme' => $theme ])
                    @endforeach
                @endif


            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        var body = $("body");

        body.on("click", ".activate_theme", function (e) {


            e.preventDefault();
            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);
            var data = {};
            data.alias = this_v.data('alias');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post("{{route('admin.themes.store')}}",
                data,
                function(r){
                    //   $(this_v).closest('tr').remove();
                    var returnedData = JSON.parse(r);
                    console.log(returnedData);
                    $('.preloader').hide();
                    if (returnedData.status == 1) {

                        $('.theme-item .ribbon ').hide();
                        this_v.closest('.theme-item').find('.ribbon').show();
                        $('.activate_theme').show();
                        this_v.hide();
                    }
                }
            );


        });


        body.on("click", ".delete_theme", function (e) {

            e.preventDefault();
            this_v = $(this);

            if (!confirm("{{ __('admin.Are you sure want delete theme?') }}  " + this_v.data('alias'))) return;

            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);
            var data = {};
            data.alias = this_v.data('alias');
            data.delete = true;


            $.ajax({
                url: '{{route('admin.themes.store')}}/',
                type: 'post', // replaced from put
                data: data,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (r) {
                    //   $(this_v).closest('tr').remove();
                    var returnedData = JSON.parse(r);
                    console.log(returnedData);
                    $('.preloader').hide();
                    if (returnedData.status == 1) {

                        this_v.closest('.theme-item').remove();
                    }
                },
                error: function (msg) {
                    $('.preloader').hide();
                }
            });
        });


        var myDropzone1;
        jQuery("#media_uploader").dropzone({
            acceptedFiles: 'application/x-zip-compressed',

            init: function () {

                this.on("complete", function (file) {
                    console.log(file);

                    obj = JSON.parse(file.xhr.response);

                    if (typeof obj.theme !== 'undefined') {
                        console.log(obj);


                        var flag = false;
                        $('.theme-item').each(function () {

                            if ($(this).data('alias') == obj.location) {
                                flag = true;
                            }
                        });

                        if (!flag) {
                            $('.theme-box').append(obj.theme);
                        }


                        // your code here

                    }

                });
                myDropzone1 = this;


            }
        });

    });

</script>