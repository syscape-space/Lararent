<form action="{{route('admin.ecommerce.email.update',['email'=>$id])}}" method="POST" class="col-md-12">
    <input type="hidden" name="_method" value="PUT">
    @csrf
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


    <h3 class="box-title ">{{$gateway->method_title}}</h3>
    <p>{{$gateway->method_description}}</p>
    <div class="row">


        @foreach($form_fields as $k => $item)
            {!! $gateway->formGroup($id, $k, $item)  !!}
        @endforeach


    </div>


    <div class="row">


        <div class="col-md-6">
            <h3 class="box-title ">Blade email template
            </h3>

            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <textarea  id="pb-module-options-code"
                        class="desc form-control"
                        rows="24">{!! $blade  !!}</textarea>
                        <input id="blade" type="hidden" value="" name="blade">
                    </div>
                </div>
            </div>

        </div>
        {{--<div class="col-md-6">--}}
        {{--<h3 class="box-title">Preview email template</h3>--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-12 ">--}}
        {{--<div class="form-group">--}}
        {{--<iframe width="100%" height="500px" src="http://lararent.loc/mailable"></iframe>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--</div>--}}
    </div>

    <button type="submit" class="btn  btn-success btn-lg pull-right"><i class="fa fa-check"></i>
        Update
    </button>

</form>

<script>
    jQuery(document).ready(function () {

        var editor = ace.edit("pb-module-options-code", {
            mode: "ace/mode/html",
            selectionStyle: "php"
        });
        editor.setOptions({
            theme: "ace/theme/cobalt",
            maxLines: 36,
            // maxLines: Infinity
            autoScrollEditorIntoView: true,
            copyWithEmptySelection: true,
            enableBasicAutocompletion: true,
            useWrapMode: true,   // wrap text to view
            indentedSoftWrap: false,
            behavioursEnabled: false, // disable autopairing of brackets and tags
            showLineNumbers: false, // hide the gutter
            // theme: "ace/theme/xcode"
        });

        editor.session.setMode("ace/mode/php");


        $(document).on('submit','form',function(e){
        // e.preventDefault();
            $('#blade').val( editor.getValue());
            console.log(editor.getValue());
        });

        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });


    });
</script>