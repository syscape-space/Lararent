<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">{{__(" Products")}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">


                        <div class="form-group row">
                            <div class="col-md-9">
                                <a href="{{route('admin.products.create')}}" type="submit"
                                   class="btn  btn-success btn-lg"><i class="fa fa-user-plus"></i>
                                    {{__('Add new Product')}}
                                </a>
                            </div>

                            <div class="col-md-3 col-xs-12 pull-right">
                                <form action="{{route('admin.products.index')}}" method="GET">
                                    <div class="row">

                                        <div class="input-group">
                                            <input name="search" value="{{$request->search ?? ''}}" type="text"
                                                   class="form-control" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>


                            </div>

                        </div>
                        @if($request->search ?? false)
                            <h3>{{__('Search result for'). ' "'. $request->search . '"'}}  </h3>
                        @endif
                        <div class="table-responsive ">

                            <table class="table product-overview " id="myTable">
                                <thead>
                                <tr>
                                    <th>{{__("Name")}}</th>
                                    <th>{{__("Categories")}}</th>
                                    <th>{{__("Price")}}</th>
                                    <th>{{__("Tags")}}</th>
                                    <th>{{__("Date")}}</th>
                                    <th>{{__("Status")}}</th>
                                    <th>{{__("Actions")}}</th>
                                </tr>
                                </thead>
                                <tbody class="products-items">


                                @if(isset($products) && is_object($products))
                                    @foreach($products as $product)
                                        @include( 'plugin:eCommerce::products.product_item')
                                    @endforeach

                                @endif
                                </tbody>
                            </table>

                            @if($products->isEmpty())
                                <h6>{{__('admin.Nothing found...')}}</h6>
                            @endif


                        </div>      <!-- Pagination -->
                        <div class="pagination-wrapper">
                            <ul class="pagination">
                                @if($products->currentPage() !== 1)
                                    <li class="disabled"><a href="{{$products->url(($products->currentPage() - 1))}}">
                                            <i class="fa fa-angle-double-left"></i></a></li>

                                @endif

                                @for($i = 1; $i <= $products->lastPage(); $i++)
                                    @if($products->currentPage() == $i)

                                        <li class="active"><a href="#">{{ $i }}
                                                <span class="sr-only"></span></a>
                                        </li>
                                    @else

                                        <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if($products->currentPage() !== $products->lastPage())

                                    <li><a href="{{ $products->url(($products->currentPage() + 1)) }}"> <i
                                                    class="fa fa-angle-double-right"></i></a></li>
                                @endif

                            </ul>
                        </div>
                        <!-- /Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function () {


        $("body").on("click", ".delete_product", function (e) {
            var this_v = $(this);
            swal({
                title: "{{__('admin.Product will be deleted permanently!')}}",
                text: "{{__('admin.Are you sure to proceed?')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{__('admin.Yes, Remove Product!')}}",
                cancelButtonText: "{{__('admin.No, I am not sure!')}}",
                // closeOnConfirm: false,
                // closeOnCancel: false
            }).
            then(function (isConfirm) {


                // alert(isConfirm);
                if (isConfirm.value) {

                    e.preventDefault();
                    $('.preloader').show().css('opacity', '0.3');


                    $.ajax({
                        url: '{{route('admin.products.index')}}/' + this_v.data('id'),
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
                    })
                }


            });
        });

        $("body").on("click", "a.clone_product", function (e) {

            e.preventDefault();
            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);


            $.ajax({
                url: this_v.attr('href'),
                type: 'post', // replaced from put
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (r) {
                    $('.preloader').hide();
                    //  $('.result').html(r);
                    $('.products-items').append(r);
                    console.log(r);
                },
                error: function (msg) {
                    $('.preloader').hide();
                }
            });
        });
    });

</script>