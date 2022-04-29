@extends('themes.' . config('settings.theme'). '.layouts.blog')

@section('sidebar')
    {{--{!! $sidebar_left !!}--}}

@endsection

@section('content')
    {!! isset($content) ? $content : '' !!}

@endsection