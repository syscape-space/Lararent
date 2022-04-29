@extends('theme:rentit::layouts.blog',
[
'sidebar' => $sidebar ?? null,
])


@section('breadcrumbs')
    {!! $breadcrumbs ?? '' !!}

@endsection

@section('sidebar')
    {!! $sidebar ?? '' !!}

@endsection






@section('content')
    {!! isset($content) ? $content : '' !!}


@endsection



@section('footer')
    {!! $footer ?? '' !!}
@endsection