<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@section('head')
<head>
  <link  rel="icon"   href="{!! asset('images/img/tunDaapo32x32.ico') !!}" type="image/ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" /><!--Description app-->
    <meta name="description" content="Diseño WEB y Marketing Digital" />
    <!--Author-->
    <meta name="author" content="Tun Daapo" />
    <!--Description app-->
    @section('description')
    <meta name="description" content="{{__('messages.Proyect to programming and web development, expert in design and Marketing Digital.')}}" />
    @show
    <meta name="generator" content="Laravel 8.0" />
    @section('keywords')
    <meta name="keywords" content="seo y marketing digital, desarrollo y programación web, web" />
    @show
    <!--App name-->
    <meta name="application-name" content="{{ config('app.name') }}" />
    <title>{{ config('app.name', 'Tun Daapo | Diseño y Marketing Digital') }}</title>
    <meta http-equiv="x-ua-compatible" content="ie-edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--CSS-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/css/fontawesome.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2-dev/css/lightbox.min.css') }}"><!--Galeria CSS Page-->
    <link rel="stylesheet" href="{{ asset('vendor/css/animate.min.css') }}"><!--Animate CSS Page-->
    <link rel="stylesheet" href="{{ asset('css/tun_daapo.css') }}">
    <!--Tags Style-->
    <link href="{{ asset('vendor/css/tagsstyle.css') }}" rel="stylesheet">

</head>
@show
<body>
    <div id="app">
        <div id="page" class="container-fluid col-12">
        @section('header')
          <img src="{!! asset('/images/img/topeheader.png') !!}" class="img-fluid mx-auto d-block">
        @show
          @section('nav')
          <nav class="navbar sticky-top navbar-expand-md navbar-dark shadow">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno"><img src="{!! asset('images/img/tunDaapo32x32.ico') !!}"></button>
            <div class="collapse navbar-collapse" id="uno">
             <ul class="navbar-nav">
               @auth
                   <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link text-light">{{__('messages.Home')}}</a></li>

               @endauth
               @guest
                   @if (Route::has('login'))
                       <li class="nav-item">
                           <a class="nav-link text-light" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                       </li>
                   @endif

                   @if (Route::has('register'))
                       <li class="nav-item">
                           <a class="nav-link text-light" href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                       </li>
                   @endif
               @else
                   <li class="nav-item dropdown">
                       <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           {{ Auth::user()->name }}
                       </a>

                       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('messages.Logout') }}
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                       </div>
                   </li>

                     <li class="nav-item"><a href="/admin" class="nav-link text-light">{{__('messages.Dashboard')}}</a></li>
               @endguest
              <li class="nav-item"><a href="#tun_daapo" class="nav-link text-light">{{__('messages.Tun Daapo')}}</a></li>
              <li class="nav-item"><a href="#services" class="nav-link text-light">{{__('messages.Services')}}</a></li>
              <li class="nav-item"><a href="#planes_precios" class="nav-link text-light">{{__('messages.Pricing')}}</a></li>
              <li class="nav-item"><a href="#portafolio" class="nav-link text-light">{{__('messages.Portfolio')}}</a></li>
              <li class="nav-item"><a href="#blog" class="nav-link text-light">{{__('messages.Blog')}}</a></li>
              <li class="nav-item"><a href="#contacto" class="nav-link text-light">{{__('messages.Contact')}}</a></li>
              <li class="nav-item"><a href="/questions-frequently" class="nav-link text-light">{{__('messages.Frequently Questions')}}</a></li>
              <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
            @if (config('locale.status') && count(config('locale.languages')) > 1)
                             <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle text-light"  id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                 {{__('messages.Languages')}}
                               </a>
                               <div class="dropdown-menu">
                                 @foreach (array_keys(config('locale.languages')) as $lang)
                                     @if ($lang != App::getLocale())
                                         <a class="dropdown-item" href="{!! route('language.select', $lang) !!}">
                                              <img src="{{ asset('images/lang/'.$lang.'.ico') }}"/>   {!! $lang !!}
                                         </a>
                                     @endif
                                 @endforeach
                               </div>
                             </li>
                      @endif
              <li class="nav-item btn btn-warning float-right" type="button"><a href="#pedir-presupuesto" class="text-dark">{{__('messages.Ask for budget')}}</a></li>
             </ul>
           </div>
          </nav>
        @show
          <div class="clearfix"></div>
        <main>
            @yield('content')
        </main>
        <div class="container-fluid col-12 mt-2 mb-2 pb-2 foot">
          <div class="clearfix"></div>
          <div class="col-12">
           <footer class="pt-2">
             <div class="col-xs-12">
               <img src="{!! asset('images/img/pie_tundaapo_para_web.png') !!}" class="mx-auto d-block rounded rounded-circle bg-warning pt-2 pr-3 pb-5">
             </div>
             <div class="text-center">
               <img src="{!! asset('images/img/ico-facebook.png') !!}" class="mx-2 my-2 img-foot">
               <img src="{!! asset('images/img/ico-instagram.png') !!}" class="mx-2 my-2 img-foot">
               <img src="{!! asset('images/img/ico-twitter.png') !!}" class="mx-2 my-2 img-foot">
             </div>
             <div class="col">
                 <p class="text-light text-center"><a href="/terms-conditions" class="text-light text-center">{{__('messages.Terms and Conditions')}}</a> |
                   <a href="/privacy-policy" class="text-light text-center">{{__('messages.Privacy Policy')}}</a></p>
                   </div>

        <h6 class="text-center text-light  font-weight-bold"> Tun Daapo.</h6>
        <h6 class="text-center text-light font-weight-bold pb-3">©2020 {{__('messages.All rights reserved')}}</h6>
           </footer>
          </div>
        </div>
        </div>
    </div>
</body>
<!--JS-->
<script src="{{ asset('vendor/lightbox2-dev/js/lightbox-plus-jquery.min.js') }}"></script><!--Galeria JS-->
<script src="{{ asset('vendor/lightbox2-dev/js/lightbox.min.js') }}"></script><!--END Galeria JS-->
<script src="{{ asset('js/tun_daapo.js') }}"></script><!--Mirakuru JS-->

<script type="text/javascript">
  window.CSRF_TOKEN = '{{ csrf_token() }}';
  @auth
     window.Permissions = {!! json_encode(Auth::user()->permissions, true) !!};
     window.UserId = {!! json_encode(Auth::user(), true) !!};
  @else
     window.Permissions = [];
     window.UserId =[];
  @endauth
</script>
</html>
