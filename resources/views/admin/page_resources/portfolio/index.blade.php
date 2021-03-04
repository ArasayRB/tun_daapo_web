@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-portfolio-component locale="{{ App::getLocale() }}">

      </index-portfolio-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
