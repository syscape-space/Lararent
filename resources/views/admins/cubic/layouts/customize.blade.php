<!DOCTYPE html>
<html lang="en" class="customize">

<head>
    <meta charset="utf-8" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16"
          href="{{ asset(config('settings.admin')) }}/plugins/images/favicon.png">
    <title>{{ $title ?? '' }}</title>

    {!! $lr_header ?? '' !!}

</head>

<body class="customize">
<!-- ===== Main-Wrapper ===== -->

<!-- ===== Top-Navigation ===== -->

<!-- ===== Top-Navigation-End ===== -->
<!-- ===== Left-Sidebar ===== -->
<div class="row" style="background-color: #4f5467;">
    {!! $content ?? '' !!}
</div>


<!-- ===== Main-Wrapper-End ===== -->
<!-- ==============================
    Required JS Files
=============================== -->

{!! $lr_footer ?? '' !!}
<script>

    if (typeof Dropzone !== "undefined") {
        Dropzone.autoDiscover = false;
    }

</script>
<div id="mediaLibrary-modal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="">
    <div class="modal-dialog media-modal-dialog" style="width: 100%">
        <div class="modal-content media-modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title"> {{__('admin.Media library')}}</h4></div>
            <div class="modal-body">
                <div class="cssload-speeding-wheel"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect"
                        data-dismiss="modal"> {{__('admin.Close')}}
                </button>
                <button type="button"
                        data-dismiss="modal"
                        class="btn btn-success waves-effect waves-light insert_img">
                    {{__('admin.Insert image')}}
                </button>
            </div>
        </div>
    </div>
</div>


</body>

</html>
