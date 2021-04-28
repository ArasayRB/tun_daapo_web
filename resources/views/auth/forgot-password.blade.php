@extends('layouts.app_tundaapo')
@section('header')
<header>

</header>
@stop
@section('nav')
<ul class="navbar sticky-top navbar-expand-md navbar-dark">
  <li class="nav-item btn btn-warning float-right" type="button"><a href="{{url(app()->getLocale().'/login')}}" class="text-dark">{{__('messages.Back')}}</a></li>
</ul>
@stop

@section('content')
@include('auth.forms.resetForm')
@endsection
@section('scripts')

@stop
