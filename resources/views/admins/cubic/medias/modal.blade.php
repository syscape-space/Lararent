<div class="row el-element-overlay m-b-20">

    <div class="col-md-12">
        <div id="resss"></div>
        <div class="white-box">

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


                </div>
            </form>
        </div>
    </div>
</div>