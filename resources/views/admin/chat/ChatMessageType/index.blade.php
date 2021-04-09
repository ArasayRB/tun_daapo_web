@extends('admin.layout.dashboard')

@section('dashboard')

@auth
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <!-- DataTales Example -->
      <index-mssgt-chat-component locale="{{ App::getLocale() }}">

      </index-mssgt-chat-component>

      </div>
    @endauth
    <!-- /.container-fluid -->
@endsection
