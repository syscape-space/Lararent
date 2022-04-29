<section class="page-section breadcrumbs text-center">
    <div class="container">
        <div class="page-header">
            <h1>Portfolio</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Portfolio</li>
        </ul>
    </div>
</section>
<!-- PAGE WITH SIDEBAR -->
<section class="page-section sub-page">
    <div class="container">

        <div class="clearfix text-center">
            <ul id="filtrable" class="filtrable clearfix">
                <li class="all current"><a href="#" data-filter="*">All</a></li>
                @if($categories ?? false)
                    @foreach($categories as $category)
                        <li class="dress"><a href="#" data-filter=".{{$category->alias}}">{{$category->title}}</a></li>
                    @endforeach
                @endif

            </ul>
        </div>

        <div class="row thumbnails portfolio isotope isotope-items">
            @if($portfolios ?? false)
                @foreach($portfolios as $portfolio)
					<?php
					$categories_arr_class = [];
					foreach ( $portfolio->porCategories as $pc ) {
						$categories_arr_class[] = $pc->alias;
					}

					?>

                    @if($style != 'alt')
                        <div class="{{$class}} isotope-item {{ implode(' ',$categories_arr_class)}} ">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <img alt="" src="{{ the_image_url($portfolio->img,'thumbnail-600x400') }}">

                                    <div class="caption hovered">
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <h3 class="caption-title"><a href="{{route('portfolio.show',['alias' => $portfolio->alias])}}">{{$portfolio->title}}</a></h3>
                                                <p class="caption-category">

												<?php
												$categories_arr = [];
												foreach ( $portfolio->porCategories as $pc ) {
													$categories_arr[] = '<a href="#">' . $pc->title . '</a>';
												}
												echo implode( ',', $categories_arr );
												?>


                                                <p class="caption-buttons">
                                                    <a href="{{ the_image_url($portfolio->img) }}"
                                                       class="btn caption-zoom" data-gal="prettyPhoto"><i
                                                                class="fa fa-search"></i></a>
                                                    <a href="{{ route('portfolio.show',['alias' => $portfolio->alias])}}"
                                                       class="btn caption-link"><i
                                                                class="fa fa-link"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                            <div class="col-md-3 col-sm-6 isotope-item  {{ implode(' ',$categories_arr_class)}}">
                                <div class="thumbnail no-border no-padding">
                                    <div class="media">
                                        <img alt="" src="{{ the_image_url($portfolio->img,'thumbnail-600x400') }}">
                                        <div class="caption hovered">
                                            <div class="caption-wrapper div-table">
                                                <div class="caption-inner div-cell">
                                                    <p class="caption-buttons">
                                                        <a href="{{ the_image_url($portfolio->img) }}" class="btn caption-zoom" data-gal="prettyPhoto"><i class="fa fa-search"></i></a>
                                                        <a href="{{route('portfolio.show',['alias' => $portfolio->alias])}}" class="btn caption-link"><i class="fa fa-link"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3 class="caption-title"><a href="{{route('portfolio.show',['alias' => $portfolio->alias])}}">{{$portfolio->title}}</a></h3>
                                        <p class="caption-category">
	                                        <?php
	                                        $categories_arr = [];
	                                        foreach ( $portfolio->porCategories as $pc ) {
		                                        $categories_arr[] = '<a href="#">' . $pc->title . '</a>';
	                                        }
	                                        echo implode( ',', $categories_arr );
	                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    @endif
                @endforeach
            @endif


        </div>


        <!-- /Blog posts -->
    @if($portfolios->lastPage() > 1)
        <!-- Pagination -->
            <div class="pagination-wrapper">
                <ul class="pagination">
                    @if($portfolios->currentPage() !== 1)
                        <li class="disabled"><a href="{{$portfolios->url(($portfolios->currentPage() - 1))}}">
                                <i class="fa fa-angle-double-left"></i></a></li>

                    @endif

                    @for($i = 1; $i <= $portfolios->lastPage(); $i++)
                        @if($portfolios->currentPage() == $i)

                            <li class="active"><a href="#">{{ $i }}
                                    <span class="sr-only"></span></a>
                            </li>
                        @else

                            <li><a href="{{ $portfolios->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($portfolios->currentPage() !== $portfolios->lastPage())

                        <li><a href="{{ $portfolios->url(($portfolios->currentPage() + 1)) }}"> <i
                                        class="fa fa-angle-double-right"></i></a></li>
                    @endif

                </ul>
            </div>
            <!-- /Pagination -->
        @endif


    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->