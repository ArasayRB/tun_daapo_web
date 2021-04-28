@extends('layouts.app_tundaapo')
@section('nav')
  @include('posts.subview.navbar')
@stop
@section('content')

<header-section-component locale="{{ App::getLocale() }}">
</header-section-component>



@endsection
@section('scripts')

@stop
