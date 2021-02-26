@extends('layouts.app_tundaapo')
@section('nav')
<ul class="navbar sticky-top navbar-expand-md navbar-dark">
  <li class="nav-item btn btn-warning float-right" type="button"><a href="/login" class="text-dark">{{__('Back')}}</a></li>
</ul>
@stop

@section('content')
@include('auth.forms.resetForm')
@endsection
