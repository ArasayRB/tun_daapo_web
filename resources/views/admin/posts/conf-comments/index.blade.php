@extends('admin.layout.dashboard')
@section('head')
  @parent
  @include('admin.subviews.head')
@endsection
@section('dashboard')


    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-conf-com-component user="{{auth()->user()->name}}" locale="{{ App::getLocale() }}">

      </index-conf-com-component>

      </div>
    <!-- /.container-fluid -->
@endsection
