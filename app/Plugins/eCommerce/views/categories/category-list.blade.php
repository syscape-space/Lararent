
@foreach($items as $item)

    <?php

    $Level = isset($item['parent_id']) && $item['parent_id'] != 0 ? $Level : 0;


    if(isset($parent_id) && $parent_id == 0) {
	    $Level =  1;
    }


    ?>
    <tr>

        <td>{!! str_repeat( '—', $Level )  !!} {{$item->title ?? ''}}

            <div class="pull-right">

                <a target="_blank"
                   href="{{route( 'productTerm', [ 'term_alias' => $item->alias]  )}}" class="text-inverse p-r-10"
                   data-toggle="tooltip" title="View"><i class="ti-eye"></i></a>
                <a href="{{  route('admin.products.categories.edit',['categories'=>$item->id, 'group' => $group])  }}" class="text-inverse p-r-10"
                   data-toggle="tooltip" title="Edit"><i
                            class="ti-marker-alt"></i></a>

                <a href="javascript:void(0)" class="delete_post text-inverse"
                   title="Delete" data-id="{{$item->id}}"
                   data-toggle="tooltip"><i class="ti-trash"></i></a>
            </div>


        </td>

        <td>{{$item->description}}</td>
        <td> </td>
        <td>
            {{$item->alias}}
        </td>
        <td>
            <span class="label label-success font-weight-100">{{
        count($item->products->where('status','published'))
        }}</span>
        </td>

        <td>





        @if(isset($com[$item->id]))


                @include( 'plugin:eCommerce::categories.category-list',
                ['items' => $com[$item->id], 'Level'=> ++$Level , 'parent_id' => $item['parent_id'] ])


        @endif
    </tr>







@endforeach