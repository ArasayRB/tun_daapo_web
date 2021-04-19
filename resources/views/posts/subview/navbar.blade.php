<nav class="navbar sticky-top navbar-expand-md navbar-dark">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno"><img src="{!! asset('images/img/tunDaapo32x32.ico') !!}"></button>
<div class="collapse navbar-collapse" id="uno">
    @if (!isset($preview))
      <ul class="navbar-nav">
        @auth
            <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link text-light">{{__('Home')}}</a></li>

        @endauth
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

              <li class="nav-item"><a href="/admin" class="nav-link text-light">{{__('Dashboard')}}</a></li>
        @endguest
       <li class="nav-item"><a href="/#tun_daapo" class="nav-link text-light">{{__('Tun Daapo')}}</a></li>
       <li class="nav-item"><a href="/#services" class="nav-link text-light">{{__('Services')}}</a></li>
       <li class="nav-item"><a href="/#planes_precios" class="nav-link text-light">{{__('Pricing')}}</a></li>
       <li class="nav-item"><a href="/#portafolio" class="nav-link text-light">{{__('Portafolio')}}</a></li>
       @if ( isset($posts) && $posts===true)
       <li class="nav-item"><a href="/#blog" class="nav-link text-light">{{__('Blog')}}</a></li>
       @endif
       <li class="nav-item"><a href="/#contacto" class="nav-link text-light">{{__('Contact')}}</a></li>
       <li class="nav-item"><a href="/questions-frequently" class="nav-link text-light">{{__('messages.Frequently Questions')}}</a></li>
       <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
     @if (config('locale.status') && count(config('locale.languages')) > 1)
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light"  id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                          {{__('Languages')}}
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
       <li class="nav-item btn btn-warning float-right" type="button"><a href="#pedir-presupuesto" class="text-dark">{{__('Pedir Presupuesto')}}</a></li>
      </ul>
@else
  <ul class="navbar-nav">
    @auth
        <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Home')}}</a></li>

    @endauth
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link text-light" href="#">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link text-light" href="#">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </li>

          <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Dashboard')}}</a></li>
    @endguest
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Tun Daapo')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Services')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Pricing')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Portafolio')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Blog')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('Contact')}}</a></li>
   <li class="nav-item"><a href="#" class="nav-link text-light">{{__('messages.Frequently Questions')}}</a></li>
   <!--Comprobamos si el status esta a true y existe más de un lenguaje-->
 @if (config('locale.status') && count(config('locale.languages')) > 1)
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light"  id="dropdownMenuLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                      {{__('Languages')}}
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
   <li class="nav-item btn btn-warning float-right" type="button"><a href="#" class="text-dark">{{__('Pedir Presupuesto')}}</a></li>
  </ul>
@endif
</nav>
