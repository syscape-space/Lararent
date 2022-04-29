<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__('admin.Post Tags')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 ">

                                {!! $form !!}

                            </div>
                            <div class="col-sm-8">

                                <div class="row">
                                    <div class="">

                                        <div class="table-responsive">
                                            <table class="table product-overview" id="myTable">


                                                <thead>
                                                <tr>
                                                    <th>{{__('admin.Name')}}</th>
                                                    <th>{{__('admin.Description')}}</th>
                                                    <th>{{__('admin.Slug')}}</th>
                                                    <th>{{__('admin.Count')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($tags as $k => $tag)
                                                    @include( 'admins.'.config('settings.admin').'.tags.list',compact('tag'))

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
                url: '{{route('admin.post_tag.index')}}/' + $(this).data('id'),
                type: 'delete', // replaced from put
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (r) {

                    r = JSON.parse(r);
                    console.log(r);
                    if (r.status)
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