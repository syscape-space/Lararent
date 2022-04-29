<!-- Blog post -->
<article class="post-wrap post-single">
    <div class="post-media">

        @if(isset($post->img) && $post->img > 0)
            <a href="{{ the_image_url($post->img) }}" data-gal="prettyPhoto">
                <img src="{{ the_image_url($post->img,'thumbnail-870x370') }}">
            </a>

        @endif
    </div>
    <div class="post-header">
        <h2 class="post-title">{!! $post->title ?? '' !!}</h2>
        <div class="post-meta">{{__('By')}} <a href="#">{{$post->user->name ?? ''}}</a> / {{ $post->created_at->format('d M Y') ?? '' }} / in

        </div>
    </div>
    <div class="post-body">
        <div class="post-excerpt">
            {!! $post->text ?? '' !!}

        </div>
    </div>
</article>
<!-- /Blog post -->

<!-- About the author -->
<div class="about-the-author clearfix">
    <div class="media">
        <img class="media-object pull-left" src="assets/img/preview/avatars/testimonial-140x140x1.jpg" alt="">
        <div class="media-body">

            <h4 class="media-heading"><a href="#">{{ $post->user->name ?? '' }}</a></h4>

        </div>
    </div>
</div>
<!-- /About the author -->

<!-- PAGE -->

{!! $relatedPosts ?? '' !!}


<section id="comments" class="page-section no-padding of-visible">
    <h4 id="comments-title" class="block-title">{{__('Comments')}}
        <small class="thin">({{count($post->comments->where('status','published')->where('locale', App::getLocale()))}} Comments)</small>
    </h4>
    <!-- Comments -->


    @if(!($post->comments->isEmpty()) > 0)
		<?php
        $com = $post->comments->where('status','published')->where('locale', App::getLocale())->groupBy( 'parent_id' );

        ?>

        <div class="comments commentlist ">


            @foreach($com as $k => $comments)


                {{--@if($k !== 1)--}}
                    {{--@break--}}
                {{--@endif--}}

                @include('theme:rentit::posts.comment',['items' => $comments, 'child' => false])

            @endforeach

        </div>

@endif



    <div id="respond"  class="comments-form">
        <h4 class="block-title" id="reply-title">{{__('Leave a Reply')}}
            <small>
                <a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">
                    {{__('Cancel reply')}}</a></small>
        </h4>
        <form action="{{ route('comment.store') }}" method="post" id="commentform">
<div class="alert alert-success dn  wrap_result"></div>

            <div class="alert alert-danger dn ">{{__('Comment error')}}</div>
            <div class="alert alert-success dn ">{{__('Comment saved')}}</div>
            @if(!Auth::check())

                <div class="form-group">
                    <input
                            type="text"
                            placeholder="{{__('Your name')}}"
                            class="form-control"
                            title="comments-form-name"
                            name="name">

                </div>
                <div class="form-group">
                    <input type="text"
                           placeholder="{{__('Your email address')}}"
                           class="form-control"
                           name="email"
                           title="comments-form-email"
                    >
                </div>


            @endif


                <div class="form-group">
                    <textarea id="comment" name="text" cols="45"
                              placeholder="Your message" class="form-control"
                              title="comments-form-comments"
                              rows="6"></textarea>
                </div>
                <div class="form-group">
                    <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $post->id }}"/>
                    <input id="comment_parent" type="hidden" name="comment_parent" value="0"/>
                    <button  type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left" id="submit"><i
                                class="fa fa-comment"></i> {{__('Send Comment')}}
                    </button>
                </div>

        </form>
    </div>
    <!-- #respond -->
</section>

<script>

</script>