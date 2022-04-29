@extends('admins.' . config('settings.admin'). '.layouts.admin')

@section('sidebar-left')
    {!! $sidebar_left !!}
@endsection

@section('content')
    {!! $content !!}
@endsection