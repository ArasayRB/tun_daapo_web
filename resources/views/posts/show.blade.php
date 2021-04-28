@extends('layouts.app_tundaapo')
@section('nethwork')
<link rel="canonical" href="http://www.tundaapoweb.localhost/">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{__('messages.Tun Daapo')}} | {{$post->title}}">
<meta property="og:description" content="{{$post->summary}}">
<meta property="og:url" content="http://www.tundaapoweb.localhost/post-list/{{$post->slug}}">
<meta property="og:site_name" content="Tun Daapo">
<meta property="article:modified_time" content="2021-03-25T19:57:01+00:00">
<meta property="og:image" content="{!! asset('/storage/img_web/login_img/'.$post->users->imagen_url) !!}">
<meta property="og:image:width" content="250">
<meta property="og:image:height" content="250">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{__('messages.Tun Daapo')}} | {{$post->title}}">
<meta name="twitter:description" content="{{$post->summary}}">
<meta name="twitter:image" content="{!! asset('/storage/img_web/login_img/'.$post->users->imagen_url) !!}">
@stop
@section('description')
  <meta name="description" content="{{$post->summary}}" />
@stop
@section('keywords')
  <meta name="keywords" content="{{$post->keywords_lang_array}}" />

  @stop
@section('header')
<header>

</header>
@stop
@section('nav')
  @include('posts.subview.navbar')
@stop
@section('red_chat')
  <div class="row float-right">
  <div class="col-lg-12">
    <container-component v-if="ventanaChat" @close="ventanaChat = false" locale="{{ App::getLocale() }}">
    </container-component>
  </div>
  <div class="container">
    <input type="checkbox" id="btn-mas" class="d-none">
    <div class="redes-chat">
      <cont-view-share-like-component v-if="ventanaChat==false" locale="{{ App::getLocale() }}" model="post" url_post="{{url('/welcome/'.$post->id)}}" id_post="{{$post->id}}" title="{{$post->title}}" cant_read="{{$post->cant_access_read}}" cant_shares="{{$post->cant_shares}}" cant_likes="{{$post->cant_likes}}">
      </cont-view-share-like-component>
      @auth ()
        <a href="#" v-if="ventanaChat==false" @click="ventanaChat = true" class=" d-block text-decoration-none bg-fuccia text-white text-center"><img src="{!! asset('images/img/comentario01.jpg') !!}" alt="" id="btn-chat" height="50px" class="img-rounded rounded rounded-circle" title="Chat with Us"></a>
        @endauth
    </div>
    <div class="btn-mas">
      <label for="btn-mas" class="fas fa-plus text-decoration-none bg-fuccia text-white text-center"></label>
    </div>
  </div>
  </div>
@stop
@section('content')
  <div class="row">

  <div class="card align-content-center col">
    <div class="box">
      @if (isset($preview))
      <div class="alert alert-primary" id='mensage'>
        <ul>
              <div class="alert alert-success font-weight-bold" role="alert">
                  {{ __('You are in Preview Post, the navbar no function, this is only for check how look before publish it') }}
              </div>

          <a type="button" href="{{url(app()->getLocale().'/admin/posts')}}" class="btn btn-primary">{{ __('messages.Back') }} {{ __('messages.Dashboard') }}</a>
        </ul>
      </div>
@endif

    <h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn card-title">{{$post->title}}</h1>
    <div class="row">


    </div>
  </div>
  <div class="panel bg-info rounded">
    <div class="row bg-light panel-header shadow mt-1">
      <h3 class="col text-center text-primary">{{ __('messages.Summary') }}</h3><br>
    </div>

    <p class="panel-body text-light mx-2 ml-2">{!!$post->summary!!}</p>
      <img src="{!! asset('/storage/img_web/login_img/'.$post->users->imagen_url) !!}" class="rounded rounded-cirlce img-fluid mb-2 mx-2">
      <strong class="d-inline-block mb-2 text-light mx-1">{{ __('messages.Posted by: ') }}{{$post->users->name}}<p class="text-light">{{$post->users->profile}}</p></strong>

  </div>
  <div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3">
      <img src="{{ asset('/storage/img_web/posts_img/'.$post->img_url) }}" title="Image: {{$post->title}}" class="img-fluid mx-auto d-block img-thumbnail ">

    </div>
    <div class="col-xs-12 col-md-6 col-lg-9">
      <p class="text-justify mx-2 my-2">{!!$post->content!!}</p>
    </div>
  </div>

      <div class="box"> <h3 class="text-center">{{ __('messages.Find us with') }} QR:</h3> <img src="{{ asset('/storage/qrcodes/posts/'.$post->qr_img_url) }}" title="Qr: {{$post->title}} Post" class="img-fluid mx-auto d-block mt-5">
  </div>
  <section class="card-footer mt-3">

    <div class="card">
      <div class="card-body">
        <relationed-tags-component locale="{{ App::getLocale() }}" id_post="{{$post->id}}">
        </relationed-tags-component>
      </div>




    </div>
    @if (!isset($preview))
    <comment-post-component id_post="{{$post->id}}" user_email="{{$post->users->email}}" answer="no" locale="{{ App::getLocale() }}">
    </comment-post-component>
     <h3 class="text-center text-dark">{{ __('messages.Comment') }}s !</h3>
    <all-comments-component id_post="{{$post->id}}" user_email="{{$post->users->email}}" answer="no" locale="{{ App::getLocale() }}">
    </all-comments-component>
   @endif
  </section>

  </div>
   @endsection
   @section('scripts')

   @stop
