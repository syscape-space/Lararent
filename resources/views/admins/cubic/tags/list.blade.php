<tr>

    <td>{{$tag->title ?? ''}}

        <div class="pull-right">


            <a href="{{  route('admin.post_tag.edit',['tag'=>$tag->id])  }}" class="text-inverse p-r-10"
               data-toggle="tooltip" title="Edit"><i
                        class="ti-marker-alt"></i></a>

            <a href="javascript:void(0)" class="delete_post text-inverse"
               title="Delete" data-id="{{$tag->id}}"
               data-toggle="tooltip"><i class="ti-trash"></i></a>
        </div>


    </td>

    <td>{{$tag->description}}</td>

    <td>
        {{$tag->alias}}
    </td>
    <td><span class="label label-success font-weight-100">{{
        count($tag->posts->where('status','published'))
        }}</span>
    </td>

    <td>





  
</tr>



