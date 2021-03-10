@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-function-included-component locale="{{ App::getLocale() }}">

      </index-function-included-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
