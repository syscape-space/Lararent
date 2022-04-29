<h5 class="widget-title-sub">{{__('Picking Up Location')}}</h5>
<div class="media">
    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
    <div class="media-body"><p>{{$request->PickingUpDate ?? ''}} /{{$request->PickingUpHour ?? ''}} </p></div>
</div>
<div class="media">
    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
    <div class="media-body"><p>{{__('From')}} {{$locations[$request->PickingUpLocation] ?? ''}}</p></div>
</div>
<h5 class="widget-title-sub">{{__('Droping Off Location')}}</h5>
<div class="media">
    <span class="media-object pull-left"><i class="fa fa-calendar"></i></span>
    <div class="media-body"><p>{{$request->DroppingOffDate ?? ''}} /{{$request->DroppingOffHour ?? ''}} </p></div>
</div>
<div class="media">
    <span class="media-object pull-left"><i class="fa fa-location-arrow"></i></span>
    <div class="media-body"><p>{{__('From')}} {{$locations[$request->DroppingOffLocation] ?? ''}}</p></div>
</div>

<h5 class="widget-title-sub">{{__('EXTRAS & FREES')}}</h5>
<div class="media">


    @if($ecommerce_cart['names']['extras'] ?? false)

        @foreach($ecommerce_cart['names']['extras'] as $item)
			<?php  if($item['duration_type'] == 'days'){ ?>
                <span class="media-object pull-left"><i class="fa fa-check-circle"></i></span>
                <div class="media-body"><p>{{$item['name']}}: {{formatted_price($item['price'] * $days )}}</p></div>

            <?php } else { ?>
            <span class="media-object pull-left"><i class="fa fa-check-circle"></i></span>
            <div class="media-body"><p>{{$item['name']}}: {{formatted_price($item['price'])}}</p></div>

			<?php  } ?>
        @endforeach
    @endif
</div>



<h5 class="widget-title-sub">{{__('Total price')}}</h5>
<div class="price">
    <strong>{{formatted_price($ecommerce_cart['total_price'] ?? 0)}}</strong> <span>{{__('/for')}} {{$days}} {{__('day(s)')}}</span>
</div>
