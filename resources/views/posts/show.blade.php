@extends('layouts.app_tundaapo')
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
@section('content')
  <div class="row">
  <aside class="col-3">


    <div class="col-3 panel bg-info rounded mr-2 mb-2 position-fixed">
      <div class="row bg-light panel-header shadow mt-1">
        <h3 class="col text-center text-primary">{{ __('messages.Summary') }}</h3><br>
        <cont-view-share-like-component class="col" model="post" url_post="{{url('/welcome/'.$post->id)}}" id_post="{{$post->id}}" title="{{$post->title}}" cant_read="{{$post->cant_access_read}}" cant_shares="{{$post->cant_shares}}" cant_likes="{{$post->cant_likes}}">
        </cont-view-share-like-component>
      </div>

      <p class="panel-body text-light">{!!$post->summary!!}</p>
        <img src="{!! asset('/storage/img_web/login_img/'.$post->users->imagen_url) !!}" class="rounded rounded-cirlce img-fluid mb-2">
        <strong class="d-inline-block mb-2 text-light">{{ __('messages.Posted by: ') }}{{$post->users->name}}<p class="text-light">{{$post->users->profile}}</p></strong>

    </div>

  </aside>

  <div class="card align-content-center col-8 ml-2">
    <div class="box">
      @if (isset($preview))
      <div class="alert alert-primary" id='mensage'>
        <ul>
              <div class="alert alert-success font-weight-bold" role="alert">
                  {{ __('You are in Preview Post, the navbar no function, this is only for check how look before publish it') }}
              </div>

          <a type="button" href="/posts" class="btn btn-primary">{{ __('messages.Back Dashboard') }}</a>
        </ul>
      </div>
@endif

    <h1 id="us_ttle" class="text-uppercase text-center pt-5 animate__animated animate__zoomIn card-title">{{$post->title}}</h1>
    <div class="row">


    </div>
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
  </section>

  </div>
   @endsection
