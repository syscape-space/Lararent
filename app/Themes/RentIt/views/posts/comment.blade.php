
@foreach($items as $item)
    <div id="li-comment-{{ $item->id }}" class="media comment comment even {{ ($item->user_id == $post->user_id) ?  'bypostauthor odd' : ''}}">
        <div id="comment-{{ $item->id }}" class="comment-container">
            <a href="#" class="pull-left comment-avatar">
		        <?php $hash = isset( $item->email ) ? md5( $item->email ) : md5( $item->user->email ) ?>

                <img alt="" src="https://www.gravatar.com/avatar/{{$hash}}?d=mm&s=75" class="avatar" height="75"
                     width="75"/>
            </a>
            <!-- .comment-author .vcard -->
            <div class="media-body">
                <p class="comment-meta"><span class="comment-author"><a href="#">{{$item->name ?? ''}}</a>
                        <span class="comment-date">   {{ is_object($item->created_at) ? $item->created_at->diffForHumans() : ''}} <i class="fa fa-flag"></i></span></span></p>
                <p class="comment-text">{{$item->text}}</p>
                <p class="comment-reply"><a href="#"
                                            onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->post_id}}&quot;)"
                    >{{__('Reply to this comment')}}</a><i class="fa fa-comment"></i></p>
            </div>
            <!-- .comment-meta .commentmetadata -->
        </div>
        <!-- #comment-##  -->

        @if(isset($com[$item->id]))


                @include('theme:rentit::posts.comment',['items' => $com[$item->id], 'child' => false])


        @endif

    </div>


@endforeach  