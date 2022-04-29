
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

                <a href="{{ isset($portfolio) ?  route( 'porCat', [ 'cat_alias' => $item->alias]  ) : route( 'postsCat', [ 'cat_alias' => $item->alias]  )}}" class="text-inverse p-r-10"
                   data-toggle="tooltip" title="View"><i class="ti-eye"></i></a>
                <a href="{{  isset($portfolio) ? route('admin.por_categories.edit',['categories'=>$item->id])  : route('admin.categories.edit',['categories'=>$item->id])  }}" class="text-inverse p-r-10"
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
        <td><span class="label label-success font-weight-100">
                <?php
                if(isset($portfolio)){
                	echo   count($item->portfolio->where('status','published'));
                } else {
	                echo   count($item->posts->where('status','published'));
                }?></span>
        </td>

        <td>





        @if(isset($com[$item->id]))


                @include( 'admins.'.config('settings.admin').'.categories.category-list',
                ['items' => $com[$item->id], 'Level'=> ++$Level , 'parent_id' => $item['parent_id'] ])


        @endif
    </tr>







@endforeach