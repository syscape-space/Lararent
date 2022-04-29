<section class="page-section breadcrumbs">
    <div class="container text-right">
        <div class="page-header">
            <h1>{{ $title ?? '' }}</h1>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{request()->root()}}">{{__('Home')}}</a></li>
            {!! $list_links ?? '' !!}
        </ul>
    </div>
</section>