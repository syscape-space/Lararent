@if($posts ?? false && is_object($posts))

    <div class="widget widget-tabs alt">
        <div class="widget-content">
            <ul id="tabs" class="nav nav-justified">
                <li><a href="#tab-s1" data-toggle="tab">Recent posts</a></li>
                <li class="active"><a href="#tab-s2" data-toggle="tab">Popular post</a></li>
            </ul>
            <div class="tab-content">
                <!-- tab 1 -->
                <div class="tab-pane fade" id="tab-s1">
                    <div class="recent-post">


                        @foreach ( $posts as $post )
                            <div class="media">

                                @if(isset($post->img) && $post->img > 0)
                                    <a class="pull-left media-link"
                                       href="{{ route('posts.show',['alias' => $post->alias]) }}"
                                       data-gal="prettyPhoto">

                                        <img data-id="{{$post->img}}" class="media-object img-responsive"
                                             alt="{{$post->title ?? ''}}"
                                             src="{{ the_image_url($post->img,'thumbnail-70x70') }}">
                                        <i class="fa fa-plus"></i>
                                    </a>

                                @endif


                                <div class="media-body">
                                    <div class="media-meta">
                                        {{ $post->created_at->format('d M Y') ?? '' }}
                                        <span class="divider">/</span><a href="#"><i
                                                    class="fa fa-comment"></i>{{count($post->comments->where('status','published')->where('locale', App::getLocale()))}}
                                        </a>
                                    </div>
                                    <h4 class="media-heading"><a
                                                href="{{ route('posts.show',['alias' => $post->alias]) }}">{{$post->title ?? ''}}</a>
                                    </h4>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

                <!-- tab 2 -->
                <div class="tab-pane fade in active" id="tab-s2">
                    <div class="recent-post">
                        @if($popular_post ?? false && is_object($popular_post))
                            @foreach ( $popular_post as $post )
                                <div class="media">

                                    @if(isset($post->img) && $post->img > 0)
                                        <a class="pull-left media-link"
                                           href="{{ route('posts.show',['alias' => $post->alias]) }}"
                                           data-gal="prettyPhoto">
                                            <img class="media-object img-responsive" alt="{{$post->title ?? ''}}"
                                                 src="{{ the_image_url($post->img,'thumbnail-70x70') }}">
                                            <i class="fa fa-plus"></i>
                                        </a>

                                    @endif


                                    <div class="media-body">
                                        <div class="media-meta">
                                            {{ $post->created_at->format('d M Y') ?? '' }}
                                            <span class="divider">/</span><a href="#"><i
                                                        class="fa fa-comment"></i>{{count($post->comments->where('status','published')->where('locale', App::getLocale()))}}
                                            </a>
                                        </div>
                                        <h4 class="media-heading"><a
                                                    href="{{ route('posts.show',['alias' => $post->alias]) }}">{{$post->title ?? ''}}</a>
                                        </h4>
                                    </div>
                                </div>

                            @endforeach
                        @endif
                    </div>

                </div>

            </div>
            <a class="btn btn-theme btn-theme-transparent btn-theme-sm btn-block" href="#">
                {{ __('MorePosts') }}
            </a>
        </div>
    </div>
@endif