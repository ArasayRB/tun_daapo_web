@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-contact-component locale="{{ App::getLocale() }}">

      </index-contact-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
