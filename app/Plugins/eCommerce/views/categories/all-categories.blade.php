<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @if( isset($group) && $group )
                        {{__('admin.Groups')}}
                    @else
                        {{__('admin.Categories')}}
                    @endif


                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 ">

                                {!! $form !!}

                            </div>
                            <div class="col-sm-8">

                                <div class="row">
                                    <div class="">
                                        <?php  $com = $categories; ?>
                                        <div class="table-responsive">
                                            <table class="table product-overview" id="myTable">



                                                <thead>
                                                <tr>
                                                    <th>{{__('admin.Name')}}</th>
                                                    <th>{{__('admin.Description')}}</th>
                                                    <th>{{__('admin.Img')}}</th>
                                                    <th>{{__('admin.Slug')}}</th>
                                                    <th>{{__('admin.Count')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($categories as $k => $comments)

                                                    @if($k !== 0)
                                                        @break
                                                    @endif

                                                    @include( 'plugin:eCommerce::categories.category-list',['items' => $comments,'Level'=> 0 ])

                                                @endforeach



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function () {


        $("body").on("click", ".delete_post", function (e) {

            e.preventDefault();
            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);

            $.ajax({
                url: '{{route('admin.products.categories.index')}}/' + $(this).data('id'),
                type: 'delete', // replaced from put
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (r) {
                    $(this_v).closest('tr').remove();
                    $('.preloader').hide();
                },
                error: function (msg) {
                    $('.preloader').hide();
                }
            });
        });

    });

</script>