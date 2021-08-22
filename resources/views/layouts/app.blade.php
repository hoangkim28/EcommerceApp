@extends('layouts.base')

@section('body')
  <div id="app" class="flex flex-col justify-center min-h-screen">
    <x-topbar></x-topbar>
    <x-header></x-header>
    @yield('content')
  
    @isset($slot)
      {{ $slot }}
    @endisset
    <x-footer></x-footer>
  </div>
@endsection