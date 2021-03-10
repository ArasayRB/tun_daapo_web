@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-paket-type-component locale="{{ App::getLocale() }}">

      </index-paket-type-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
