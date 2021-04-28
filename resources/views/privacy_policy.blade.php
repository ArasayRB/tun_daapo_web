@extends('layouts.app_tundaapo')
@section('nav')
  @include('posts.subview.navbar')
@stop
@section('content')

<privacy-policy-section-component locale="{{ App::getLocale() }}">
</privacy-policy-section-component>


@endsection
@section('scripts')

@stop
