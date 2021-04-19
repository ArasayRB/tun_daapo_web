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
    <meta name="description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    @section('nethwork')
    <link rel="canonical" href="http://www.tundaapoweb.localhost/">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{__('messages.Tun Daapo | Digital Marketing and Web Design in Cuba')}}">
    <meta property="og:description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
    <meta property="og:url" content="http://www.tundaapoweb.localhost/">
    <meta property="og:site_name" content="Tun Daapo">
    <meta property="article:modified_time" content="2021-03-25T19:57:01+00:00">
    <meta property="og:image" content="http://www.tundaapoweb.localhost/images/img/pie_tundaapo_para_web.png">
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="250">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{__('messages.Tun Daapo | Digital Marketing and Web Design in Cuba')}}">
    <meta name="twitter:description" content="{{__('messages.Tun Daapo: Digital Marketing and Web Design since Cuba. Freelancer Small Agency specialist web development and marketing to PYMES and freelancers.')}}">
    <meta name="twitter:image" content="http://www.tundaapoweb.localhost/images/img/pie_tundaapo_para_web.png">
    @show
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
    <title>{{ config('app.name', 'messages.Tun Daapo | Digital Marketing and Web Design in Cuba') }}</title>
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
        <div class="sticky-top">
          @section('nav')
          <nav class="navbar navbar-expand-md navbar-dark shadow">
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
              @if ( isset($posts) && $posts===true)
              <li class="nav-item"><a href="#blog" class="nav-link text-light">{{__('messages.Blog')}}</a></li>
              @endif
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

          <accept-cookies-component>
          </accept-cookies-component>
          @section('red_chat')
            <div class="row float-right">
            <div class="col-lg-12">
              <container-component v-if="ventanaChat" @close="ventanaChat = false">
              </container-component>
            </div>
            <div class="container">
              <input type="checkbox" id="btn-mas" class="d-none">
              <div class="redes-chat">
                <a href="#" v-if="ventanaChat==false" class="fab fa-facebook d-block text-decoration-none bg-fuccia text-white text-center"></a>
                <a href="#" v-if="ventanaChat==false" class="fab fa-twitter  d-block text-decoration-none bg-fuccia text-white text-center"></a>
                <a href="#" v-if="ventanaChat==false" class="fab fa-instagram  d-block text-decoration-none bg-fuccia text-white text-center"></a>
                @auth ()
                <a href="#" v-if="ventanaChat==false" @click="ventanaChat = true" class=" d-block text-decoration-none bg-fuccia text-white text-center"><img src="{!! asset('images/img/comentario01.jpg') !!}" alt="" id="btn-chat" height="50px" class="img-rounded rounded rounded-circle" title="Chat with Us"></a>
                @endauth
              </div>
              <div class="btn-mas">
                <label for="btn-mas" class="fas fa-plus text-decoration-none bg-fuccia text-white text-center"></label>
              </div>
            </div>
          </div>
         @show
        </div>

          <div class="clearfix"></div>
        <main class="mt-5">
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
@section('scripts')
<script src="{{ asset('vendor/lightbox2-dev/js/lightbox-plus-jquery.min.js') }}"></script><!--Galeria JS-->
<script src="{{ asset('vendor/lightbox2-dev/js/lightbox.min.js') }}"></script><!--END Galeria JS-->
<script src="{{ asset('js/tun_daapo.js') }}"></script><!--Tun_Daapo JS-->
@show

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
