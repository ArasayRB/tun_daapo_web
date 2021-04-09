@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-room-chat-component locale="{{ App::getLocale() }}">

      </index-room-chat-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
