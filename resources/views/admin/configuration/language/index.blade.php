@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-language-component locale="{{ App::getLocale() }}">

      </index-language-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
