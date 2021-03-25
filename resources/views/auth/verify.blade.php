@extends('layouts.app_tundaapo')

@section('header')
<header>

</header>
@stop
@section('nav')
<ul class="navbar sticky-top navbar-expand-md navbar-dark">
  <li class="nav-item btn btn-warning float-right" type="button"><a href="/" class="text-dark">{{__('messages.Back')}}</a></li>
</ul>
@stop

@section('content')
  <div class="contenedor-slider-testimonios" id="portafolio">
    <div class="testimonial-slider">
      <div class="slider-overflow">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-dark font-weight-bold text-center">{{ __('messages.Verify Your Email Address') }}</div>

                <div class="card-body text-dark">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('messages.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('messages.Before proceeding, please check your email for a verification link.') }}
                    {{ __('messages.If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-dark">{{ __('messages.click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
