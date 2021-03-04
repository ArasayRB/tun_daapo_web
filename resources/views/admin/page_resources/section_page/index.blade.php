@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-sectionpage-component locale="{{ App::getLocale() }}">

      </index-sectionpage-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
