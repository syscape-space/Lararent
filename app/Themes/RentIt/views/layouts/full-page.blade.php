@include('theme:rentit::layouts.header')

<!-- /HEADER -->

<!-- CONTENT AREA -->
<div class="content-area pb-edit-content" data-p-id="{{app( 'request' )->route()->controller->page_id ?? ''}}">

  {!! $content ?? '' !!}

</div>
<!-- /CONTENT AREA -->

<!-- FOOTER -->
@include('theme:rentit::footer')
<!-- /FOOTER -->

<div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /WRAPPER -->

{!!   $lr_footer ?? '' !!}
</body>
</html>