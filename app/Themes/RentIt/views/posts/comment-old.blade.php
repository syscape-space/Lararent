@foreach($items as $item)
    <div id="li-comment-{{ $item->id }}"
         class="media comment {{ ($item->user_id == $post->user_id) ?  'bypostauthor odd' : ''}}">

        <a href="#" class="pull-left comment-avatar">
		    <?php $hash = isset( $item->email ) ? md5( $item->email ) : md5( $item->user->email ) ?>

            <img alt="" src="https://www.gravatar.com/avatar/{{$hash}}?d=mm&s=75" class="avatar" height="75"
                 width="75"/>
        </a>
            <!-- .comment-author .vcard -->
            <div class="media-body">
                <p class="comment-meta"><span class="comment-author"><a
                                href="#">{{$item->id}} {{$item->user->name or $item->name}}</a>
															<span class="comment-date"> {{ is_object($item->created_at) ? $item->created_at->format('F d, Y \a\t H:i') : ''}}
                                                                <i class="fa fa-flag"></i></span></span></p>
                <p class="comment-text">{{$item->text}}</p>
                <p class="comment-reply">
                    <a class="comment-reply-link" href="#respond"
                       onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->post_id}}&quot;)">Reply</a>
                    <i class="fa fa-comment"></i></p>

                <!-- .reply -->

                @if(isset($com[$item->id]))

                    @include('theme:rentit::posts.comment',['items' => $com[$item->id],'child' => true])


                @endif
            </div>
            <!-- .comment-meta .commentmetadata -->

        <!-- #comment-##  -->


    </div>


@endforeach