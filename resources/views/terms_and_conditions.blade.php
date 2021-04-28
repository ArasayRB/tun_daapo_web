@extends('layouts.app_tundaapo')
@section('nav')
  @include('posts.subview.navbar')
@stop
@section('content')

<terms-conditions-section-component locale="{{ App::getLocale() }}">
</terms-conditions-section-component>


@endsection
@section('scripts')

@stop
