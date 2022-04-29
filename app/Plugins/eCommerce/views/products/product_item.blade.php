
<tr>
    <td>
        <a href="{{  route('admin.products.edit',['product'=>$product->id])  }}">
            @if($product->img > 0)
                <img src="{{ the_image_url($product->img,'thumbnail-260x260') }}"
                     alt="{{$product->title}}"
                     width="80">
            @endif

            {{$product->title}}
        </a>
    </td>
    <td></td>
    <td>


        {{$product->price ?? ''}}
    </td>
    <td>{{__("....")}}</td>
    <td>{{$product->created_at->format('d-m-Y') ?? ''}}</td>
    <td>{{$product->created_at->format('d-m-Y') ?? ''}}</td>
    <td><span class="label label-success font-weight-100">
                                            {{$product->status ?? ''}}
                                        </span></td>
    <td>
        <a href="{{  route('admin.products.edit',['product'=>$product->id])  }}"
           class="text-inverse p-r-10" data-toggle="tooltip" title=""
           data-original-title="Edit"><i class="ti-marker-alt"></i></a>

        <a href="{{  route('admin.product.clone',['product'=>$product->id])  }}"
           class="text-inverse p-r-10 clone_product" data-toggle="tooltip"
           title="{{__('admin.Clone')}}">
            <i class="fa fa-clone"></i></a>

        <a href="javascript:void(0)" class="text-inverse delete_product"
           title=""
           data-id="{{$product->id}}"
           data-toggle="tooltip" data-original-title="{{__('admin.Delete')}}">
            <i class="ti-trash"></i></a></td>
</tr>
