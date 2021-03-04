@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-service-component locale="{{ App::getLocale() }}">

      </index-service-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
