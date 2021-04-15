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
      <index-category-component user="{{auth()->user()->name}}" locale="{{ App::getLocale() }}">

      </index-category-component>

      </div>
    <!-- /.container-fluid -->
@endsection
