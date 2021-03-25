<head>
  <link  rel="icon"   href="{{ asset('images/img/favicon.ico') }}" type="image/ico" />
  <!--Required Meta taggs-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="apple-mobile-web-app-capable" content="yes" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />

  <meta name="description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <link rel="canonical" href="https://sitelabs.es/">
  <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{__('messages.Tun Daapo | Digital Marketing and Web Design in Cuba')}}">
  <meta property="og:description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
  <meta property="og:url" content="http://tundaapoweb.localhost/">
  <meta property="og:site_name" content="Tun Daapo">
  <meta property="article:modified_time" content="2021-03-25T19:57:01+00:00">
  <meta property="og:image" content="http://tundaapoweb.localhost/images/img/pie_tundaapo_para_web.png">
  <meta property="og:image:width" content="250">
  <meta property="og:image:height" content="250">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{__('messages.Tun Daapo | Digital Marketing and Web Design in Cuba')}}">
  <meta name="twitter:description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
  <meta name="twitter:image" content="http://tundaapoweb.localhost/images/img/pie_tundaapo_para_web.png">
  <!--Author-->
  <meta name="author" content="{{$post->users->name}}, {{$post->users->email}}" />

  <!--Description app-->
  <meta name="description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}" />

  <!--Topic-->
  <meta name="topic" content="{{$post->title}}" />

  <!--Summary-->
  <meta name="summary" content="{{$post->summary}}" />

  <meta name="generator" content="Laravel 8.0" />

  <meta name="keywords" content="{{$post->keywords}}" />

  <!--App name-->
  <meta name="application-name" content="{{ config('app.name') }}" />
  <title>{{$post->title}}|{{ config('app.name', 'Hostal MIRAKURU Gran Familia') }}</title>
  <meta http-equiv="x-ua-compatible" content="ie-edge">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!--CSS-->
  <link rel="stylesheet" href="{{ asset('vendor/css/fontawesome.min.css') }}"><!--Galeria CSS Page-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/css/lightbox.min.css') }}"><!--Galeria CSS Page-->
  <link rel="stylesheet" href="{{ asset('vendor/css/animate.min.css') }}"><!--Animate CSS Page-->
  <link rel="stylesheet" href="{{ asset('css/all.css') }}">
</head>
