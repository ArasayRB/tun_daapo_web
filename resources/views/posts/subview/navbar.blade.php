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
                    <a class="nav-link text-light" href="{{ route('login',app()->getLocale()) }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('register',app()->getLocale()) }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout',app()->getLocale()) }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout',app()->getLocale()) }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>

              <li class="nav-item"><a href="{{url(app()->getLocale().'/admin')}}" class="nav-link text-light">{{__('Dashboard')}}</a></li>
        @endguest
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#tun_daapo')}}" class="nav-link text-light">{{__('Tun Daapo')}}</a></li>
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#services')}}" class="nav-link text-light">{{__('Services')}}</a></li>
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#planes_precios')}}" class="nav-link text-light">{{__('Pricing')}}</a></li>
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#portafolio')}}" class="nav-link text-light">{{__('Portafolio')}}</a></li>
       @if ( isset($posts) && $posts===true)
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#blog')}}" class="nav-link text-light">{{__('Blog')}}</a></li>
       @endif
       <li class="nav-item"><a href="{{url(app()->getLocale().'/#contacto')}}" class="nav-link text-light">{{__('Contact')}}</a></li>
       <li class="nav-item"><a href="{{url(app()->getLocale().'/questions-frequently')}}" class="nav-link text-light">{{__('messages.Frequently Questions')}}</a></li>

       <li class="nav-item btn btn-warning float-right" type="button"><a href="{{url(app()->getLocale().'/#pedir-presupuesto')}}" class="text-dark">{{__('messages.Ask for budget')}}</a></li>
      </ul>
@else
  <ul class="navbar-nav" disabled>
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

   <li class="nav-item btn btn-warning float-right" type="button"><a href="#" class="text-dark">{{__('messages.Ask for budget')}}</a></li>
  </ul>
@endif
</nav>
