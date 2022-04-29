@if($products && $products->total() > 0)


    @foreach($products as $product)
		<?php        $product_meta = getProductMetas( $product );?>



        <div class="thumbnail no-border no-padding thumbnail-car-card clearfix ">
            <div class="media">

                @if(isset($product->img) && $product->img > 0)
                    <a class="media-link" href="{{ the_image_url($product->img) }}" data-gal="prettyPhoto">
                        <img src="{{ the_image_url($product->img,'thumbnail-370x220') }}">
                    </a>

                @endif
            </div>
            <div class="caption">
                <div class="rating">
	                <?php
	                $star_active =  $product_meta['product_stars'] ?? 5;
	                $star        = 5 - $star_active;
	                echo ( str_repeat( ' <span class="star"></span>', $star ) );
	                echo ( str_repeat( ' <span class="star active"></span>', $star_active ) );	                ?>

                </div>
                <h4 class="caption-title"><a
                            href="{{route('products.show',['products'=> $product->alias ])}}">{{$product->title ?? ''}}</a>
                </h4>
                <h5 class="caption-title-sub">{!!  str_replace('%price%',ec_price($product->final_cost ?? $product->price),
                get_theme_mod('rentit_product_list_price_format',__('Start from %price% /per a day')))  !!}
                </h5>
                <div class="caption-text">
                    {!!  $product->desc  !!}</div>


                <table class="table">
                    <tbody>
                    <tr>
						<?php
						if($product_meta['product_icons'] ?? false) {
						    $product_icons = unserialize( $product_meta['product_icons'] );


						    if ( is_array( $product_icons ) && $product_icons['icon'] ?? false && $product_icons['text'] ?? false) {
						    $product_icons = array_combine( $product_icons['icon'], $product_icons['text'] );


						    $j = 0;
						        foreach ( $product_icons as $k => $text ) {  ?>
                                     <td><i class="fa {{$k}}"></i> {{$text}}</td>
						        <?php
						         }
						    }
						}
						?>

                        <td class="buttons"><a class="btn btn-theme"
                                               href="{{route('products.show',['products'=> $product->alias ])}}">
                                {{get_theme_mod('rentit_rent_it',__('Rent It'))}}

                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>



    @endforeach
@else
    <h1>{{__('By your request products not found, try again')}}</h1>
@endif




<!-- /Blog posts -->
@if($products->lastPage() > 1)
    <!-- Pagination -->
    <div class="pagination-wrapper">
        <ul class="pagination">
            @if($products->currentPage() !== 1)
                <li class="disabled"><a href="{{$products->url(($products->currentPage() - 1))}}">
                        <i class="fa fa-angle-double-left"></i>{{__('Previous')}} </a></li>

            @endif

            @for($i = 1; $i <= $products->lastPage(); $i++)
                @if($products->currentPage() == $i)

                    <li class="active"><a href="#">{{ $i }}
                            <span class="sr-only">(current)</span></a>
                    </li>
                @else

                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if($products->currentPage() !== $products->lastPage())

                <li><a href="{{ $products->url(($products->currentPage() + 1)) }}">{{__('Next')}} <i
                                class="fa fa-angle-double-right"></i></a></li>
            @endif

        </ul>
    </div>
    <!-- /Pagination -->
@endif


