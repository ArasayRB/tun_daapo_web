@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-roomt-chat-component locale="{{ App::getLocale() }}">

      </index-roomt-chat-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
