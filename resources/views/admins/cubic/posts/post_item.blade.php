<tr>
    <td>
        <a href="{{  route('admin.posts.edit',['posts'=>$post->id])  }}">
            @if($post->img > 0)
                <img src="{{ the_image_url($post->img,'thumbnail-260x260') }}"
                     alt="{{$post->title}}"
                     width="80">
            @endif

            {{$post->title}}</a>
    </td>
    <td>{{$post->category->title ?? ''}}</td>
    <td>
        {{--<img src="http://lararent.test/cubic/plugins/images/users/hanna.jpg" alt="iMac"--}}
        {{--width="80">--}}
        {{----}}
        {{$post->user->name}}
    </td>
    <td>....</td>
    <td>0</td>
    <td>{{$post->created_at->format('d-m-Y') ?? ''}}</td>
    <td><span class="label label-success font-weight-100">{{__('admin.Published')}}</span></td>
    <td>
        <a href="{{  route('admin.posts.clone',['posts'=>$post->id])  }}"
           class="text-inverse p-r-10 clone_post" data-toggle="tooltip"
           title="{{__('admin.Clone')}}">
            <i class="fa fa-clone"></i></a>

        <a href="{{  route('admin.posts.edit',['posts'=>$post->id])  }}"
           class="text-inverse p-r-10" data-toggle="tooltip"
           title="{{__('admin.Edit')}}"><i class="ti-marker-alt"></i></a>

        <a
                href="javascript:void(0)"
                class="text-inverse delete_post"
                title="{{__('admin.Delete')}}"
                data-id="{{$post->id}}"
                data-toggle="tooltip"><i
                    class="ti-trash"></i></a></td>
</tr>