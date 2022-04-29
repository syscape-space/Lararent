<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"> {{__('admin.Comments')}}</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-md-9">
                                @if($request->search ?? false)
                                    <h3>{{__('Search result for'). ' "'. $request->search . '"'}}  </h3>
                                @endif

                            </div>

                            <div class="col-md-3 col-xs-12 pull-right">
                                <form action="{{route('admin.comments.index')}}" method="GET">
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

                        <div class="table-responsive ">

                            <table class="table product-overview " id="myTable">
                                <thead>
                                <tr>
                                    <th>{{__('admin.Author')}}</th>
                                    <th>{{__('admin.Comment')}}</th>
                                    <th>{{__('admin.In Respond To')}}</th>
                                    <th>{{__('admin.Submitted On')}}</th>
                                    <th>{{__('admin.Actions')}}</th>

                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($comments) && is_object($comments))
                                    @foreach($comments as $comment)



                                        <tr>
                                            <td>
                                                <a href="{{  route('admin.comments.edit',['comments'=>$comment->id])  }}">
                                                    {{$comment->name}}
                                                </a>
                                            </td>
                                            <td>{!! $comment->text  !!}</td>
                                            <td>


                                                {{__('In response to:')}} <a
                                                        href="{{  route('admin.posts.edit',['post'=>$comment->post->id])  }}"
                                                        class="">{{$comment->post->title}}</a>

                                            </td>
                                            <td>
                                                {{$comment->created_at}}
                                            </td>

                                            <td>
                                                <a href="{{  route('admin.comments.edit',['comments'=>$comment->id])  }}"
                                                   class="text-inverse p-r-10" data-toggle="tooltip"
                                                   title="{{__('admin.Edit')}}"><i class="ti-marker-alt"></i></a>

                                                <a
                                                        href="javascript:void(0)"
                                                        class="text-inverse delete_post"
                                                        title="{{__('admin.Delete')}}"
                                                        data-id="{{$comment->id}}"
                                                        data-toggle="tooltip"><i
                                                            class="ti-trash"></i></a></td>
                                        </tr>
                                    @endforeach

                                @endif
                                </tbody>
                            </table>

                            @if($comments->isEmpty())
                                <h6>{{__('admin.Nothing found...')}}</h6>
                        @endif
                        <!-- Pagination -->
                            <div class="pagination-wrapper">
                                <ul class="pagination">
                                    @if($comments->currentPage() !== 1)
                                        <li class="disabled"><a
                                                    href="{{$comments->url(($comments->currentPage() - 1))}}">
                                                <i class="fa fa-angle-double-left"></i></a></li>

                                    @endif

                                    @for($i = 1; $i <= $comments->lastPage(); $i++)
                                        @if($comments->currentPage() == $i)

                                            <li class="active"><a href="#">{{ $i }}
                                                    <span class="sr-only"></span></a>
                                            </li>
                                        @else

                                            <li><a href="{{ $comments->url($i) }}">{{ $i }}</a></li>
                                        @endif
                                    @endfor

                                    @if($comments->currentPage() !== $comments->lastPage())

                                        <li><a href="{{ $comments->url(($comments->currentPage() + 1)) }}"> <i
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

</div>


<script>
    $(document).ready(function () {


        $("body").on("click", ".delete_post", function (e) {

            e.preventDefault();
            $('.preloader').show().css('opacity', '0.3');
            var this_v = $(this);

            $.ajax({
                url: '{{route('admin.comments.index')}}/' + $(this).data('id'),
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