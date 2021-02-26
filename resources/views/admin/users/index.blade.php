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
      <index-user-component user="{{auth()->user()->name}}" user_id="{{auth()->user()->id}}" locale="{{ App::getLocale() }}">

      </index-user-component>

      </div>
    <!-- /.container-fluid -->
@endsection
