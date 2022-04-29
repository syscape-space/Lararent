<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{__('Coupons')}} </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{route('admin.ecommerce.coupons.create')}}" type="submit"
                            class="btn  btn-success btn-lg">
                            {{__('Add new coupon')}}
                            </a>
                        </div>
                        <div class="table-responsive ">

                            <table class="table product-overview " id="myTable">
                                <thead>
                                <tr>
                                    <th>{{__('Title')}} </th>
                                    <th>{{__('Actions')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$coupons->isEmpty())


                                    @foreach($coupons as $location)

                                        <tr>
                                            <td>
                                                <a href="{{route('admin.ecommerce.coupons.edit',['location' => $location->id])}}">
                                                    {{$location->code}}

                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.ecommerce.coupons.edit',['location' => $location->id])}}"
                                                   class="text-inverse p-r-10"
                                                   data-toggle="tooltip" title=""
                                                   data-original-title="{{__('admin.Edit')}}"><i
                                                            class="ti-marker-alt"></i></a>

                                                <a href="javascript:void(0)" class="text-inverse delete_location"
                                                   title=""
                                                   data-id="{{ $location->id}}" data-toggle="tooltip"
                                                   data-original-title="{{__('admin.Delete')}}"><i
                                                            class="ti-trash"></i></a></td>
                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                            @if($coupons->isEmpty())
                                <div class="col-md-12">
                                    {{__('Coupons not found. Please Add new Coupons')}}
                                </div>


                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {


        $("body").on("click", ".delete_location", function (e) {


            var this_v = $(this);
            var id = this_v.data('id');
            e.preventDefault();
            swal({
                title: "Location will be deleted permanently!",
                text: "Are you sure to proceed?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove Location!",
                cancelButtonText: "No, I am not sure!",
                // closeOnConfirm: false,
                // closeOnCancel: false
            }).then(function (isConfirm) {


                // alert(isConfirm);
                if (isConfirm.value) {
                    console.log(isConfirm);
                    $('.preloader').show().css('opacity', '0.3');


                    $.ajax({
                        url: '{{ route('admin.ecommerce.coupons.index')  }}/' +id,
                        type: 'delete', // replaced from put
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (r) {
                            if (r.success)
                                $(this_v).closest('tr').remove();

                            $('.preloader').hide();
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

    });

</script>