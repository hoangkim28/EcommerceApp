@extends('layouts.base')

@section('body')
  <div id="app" class="flex flex-col justify-center min-h-screen">
    <x-header></x-header>
    @yield('content')
    <x-footer></x-footer>
  </div>
  @isset($slot)
    {{ $slot }}
  @endisset
@endsection