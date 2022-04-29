
<section class="page-section breadcrumbs text-center">
    <div class="container">
        <div class="page-header">
            <h1>{{$portfolio->title}}</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{request()->root()}}">{{__('Home')}}</a></li>
            <li class="active"><a href="{{route('portfolio.index')}}">{{__('Portfolio')}}</a></li>
        </ul>
    </div>
</section>
<!-- PAGE WITH SIDEBAR -->

<section class="page-section sub-page">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 project-media">

                <div class="img-carousel">


                    <div><img src="{{the_image_url($portfolio->img ?? 0)}}" alt=""/></div>

                    @if(isset($gallery_media[0]))
                        @foreach($gallery_media as $media)
                            <div><img src="{{the_image_url($media)}}" alt=""/></div>
                        @endforeach

                    @endif


                </div>
            </div>

            <div class="col-lg-4 col-md-5 col-sm-7">
                <div class="project-overview">
                    <h3 class="block-title"><span>Project Overview</span></h3>

                    {!!  $portfolio->text !!}
                </div>

                <div class="project-details">
                    <h3 class="block-title"><span>Project Details</span></h3>
                    <dl class="dl-horizontal">
                        <dt>Categories</dt>
                        <dd>
                            @foreach($portfolio->porCategories as $category)
                                <a href="#"> {{$category->title}}</a>,
                            @endforeach

                            <a href="#">Dress</a>, <a href="#">Jackets</a>, <a href="#">Boots</a></dd>
                        <dt>Release Date</dt>
                        <dd>{{ $portfolio->created_at->format('d M, Y') ?? '' }}</dd>
                    </dl>
                </div>
            </div>

        </div>

        <hr class="page-divider"/>

        <div class="pager">

            @if($older)
                <a class="btn btn-theme btn-theme-transparent pull-left btn-icon-left"
                   href="{{ route('portfolio.show',['alias' => $older->alias])}}"><i
                            class="fa fa-angle-double-left"></i>Older</a>
            @endif

                @if($newer)
            <a class="btn btn-theme btn-theme-transparent pull-right btn-icon-right" href="{{ route('portfolio.show',['alias' => $newer->alias])}}">Newer <i
                        class="fa fa-angle-double-right"></i></a>
                @endif

        </div>

        <hr class="page-divider half"/>

        @if($relatedPortfolio )

            <h2 class="block-title">Related project</h2>

            <div class="row thumbnails portfolio">

                @foreach($relatedPortfolio as $item)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="{{ the_image_url($item->img,'thumbnail-600x400') }}"
                                     alt="">
                                <div class="caption hovered">
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <h3 class="caption-title"><a href="#">{{$item->title}}</a></h3>
                                            <p class="caption-category">
                                                @foreach($item->porCategories as $category)
                                                    <a href="#"> {{$category->title}}</a>,
                                                @endforeach

                                            </p>
                                            <p class="caption-buttons">
                                                <a href="{{the_image_url($item->img)}}"
                                                   class="btn caption-zoom" data-gal="prettyPhoto"><i
                                                            class="fa fa-search"></i></a>
                                                <a href="{{ route('portfolio.show',['alias' => $item->alias])}}"
                                                   class="btn caption-link"><i
                                                            class="fa fa-link"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif

    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
