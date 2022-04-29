<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{__('admin.Posts')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-md-9">
                                <a href="{{ route('admin.posts.create') }}" type="submit"
                                   class="btn  btn-success btn-lg"><i
                                            class="fa fa-user-plus"></i>
                                    {{__('admin.Add new post')}}
                                </a>
                            </div>

                            <div class="col-md-3 col-xs-12 pull-right">
                                <form action="{{route('admin.posts.index')}}" method="GET">
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
                                    <th>{{__('admin.Title')}}</th>
                                    <th>{{__('admin.Categories')}}</th>
                                    <th>{{__('admin.Author')}}
                                    </th>
                                    <th> {{__('admin.Tags')}}</th>
                                    <th><i class="ti-comment-alt"></i></th>
                                    <th>{{__('admin.Date')}}</th>
                                    <th>{{__('admin.Status')}}</th>
                                    <th>{{__('admin.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($posts) && is_object($posts))
                                    @foreach($posts as $post)
                                        @include( 'admins.'.config('settings.admin').'.posts.post_item')

                                    @endforeach


                                @endif
                                </tbody>
                            </table>

                            @if($posts->isEmpty())
                             <h6>{{__('admin.Nothing found...')}}</h6>
                            @endif

                        </div>


                        <!-- /Blog posts -->

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            <ul class="pagination">
                                @if($posts->currentPage() !== 1)
                                    <li class="disabled"><a href="{{$posts->url(($posts->currentPage() - 1))}}">
                                            <i class="fa fa-angle-double-left"></i></a></li>

                                @endif

                                @for($i = 1; $i <= $posts->lastPage(); $i++)
                                    @if($posts->currentPage() == $i)

                                        <li class="active"><a href="#">{{ $i }}
                                                <span class="sr-only"></span></a>
                                        </li>
                                    @else

                                        <li><a href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if($posts->currentPage() !== $posts->lastPage())

                                    <li><a href="{{ $posts->url(($posts->currentPage() + 1)) }}"> <i
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


        $("body").on("click", ".delete_post", function (e) {

            e.preventDefault();
            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);

            $.ajax({
                url: '{{route('admin.posts.index')}}/' + $(this).data('id'),
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


        $("body").on("click", "a.clone_post", function (e) {

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
                    this_v.closest('tr').before(r);
                    //      $('.products-items').append(r);
                    console.log(r);
                },
                error: function (msg) {
                    $('.preloader').hide();
                }
            });
        });

    });

</script>