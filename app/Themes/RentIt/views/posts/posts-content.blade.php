@if(!empty($posts) && !$posts->isEmpty()
)

    @foreach($posts as $post)


        <!-- Blog posts -->
        <article class="post-wrap">
            <div class="post-media">

                @if(isset($post->img) && $post->img > 0)
                    <a href="{{ the_image_url($post->img) }}" data-gal="prettyPhoto">
                        <img src="{{ the_image_url($post->img,'thumbnail-870x370') }}">
                    </a>

                @endif

            </div>
            <div class="post-header">
                <h2 class="post-title"><a
                            href="{{ route('posts.show',['alias' => $post->alias]) }}">{{ $post->title }}</a></h2>



                <div class="post-meta">{{__('By')}} <a href="#">{{ $post->user->name ?? '' }}

                    </a> / {{$post->created_at->format('d M Y') ?? ''}}  /

                    @if(is_object($post->categories) && $post->categories && isset($post->categories[0]->alias) )

                    {{__('in')}}

                    @foreach($post->categories as $category)
                            <a href="{{route('postsCat',['cat_alias'=> $category->alias ])}}"> {{$category->title}}</a>,
                    @endforeach
                    @endif
                    /
                    <a href="#">({{count($post->comments->where('status','published')->where('locale', App::getLocale()))}} Comments)</a>
                        </div>
            </div>
            <div class="post-body">
                <div class="post-excerpt">
                    <p>{{$post->desc}}</p>
                </div>
            </div>
            <div class="post-footer">
                <span class="post-read-more">
                    <a href="{{ route('posts.show',['alias' => $post->alias]) }}"

                       class="btn btn-theme btn-theme-transparent btn-icon-left">{{__('Read more')}}</a>



                </span>
            </div>
        </article>
        <!-- / -->
    @endforeach

@else
    <h1>{{__('Nothing found')}} </h1>
@endif
