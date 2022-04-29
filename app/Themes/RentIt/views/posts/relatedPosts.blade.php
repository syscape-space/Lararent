<section class="page-section of-visible">

    <h2 class="block-title">{{__('Related Posts')}}</h2>
    <div class="row">
        @if($relatedPosts ?? false )

            @foreach($relatedPosts as $post)

                <div class="col-md-6">
                    <div class="recent-post alt">
                        <div class="media">
                            <a class="media-link" href="#">
                                <div class="badge type">
                                    {{--{{$post->categories()->first()->title ?? ''}}--}}
                                </div>
                                <div class="badge post"><i class="fa fa-video-camera"></i></div>
                                @if(isset($post->img) && $post->img > 0)

                                        <img class="media-object"  src="{{ the_image_url($post->img,'thumbnail-570x270') }}">

                                @endif
                                <i class="fa fa-plus"></i>
                            </a>
                            <div class="media-left">
                                <div class="meta-date">
                                    <div class="day">{{$post->created_at->format('d')}}</div>
                                    <div class="month">{{$post->created_at->format('M')}}</div>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="media-meta">
                                    {{__('By')}} {{$post->user->name ?? ''}}

                                </div>
                                <h4 class="media-heading"><a href="{{ route('posts.show',['alias' => $post->alias]) }}">{{$post->title}}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif


    </div>
</section>
<!-- /PAGE -->