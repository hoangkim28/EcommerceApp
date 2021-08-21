@extends('layouts.base')

@section('body')
<x-header></x-header>
<main>
  <div class="mx-auto max-w-6xl">
    <div class="py-12 max-w-6xl mx-auto">
    @yield('content')
    </div>
  </div>
</main>
@isset($slot)
{{ $slot }}
@endisset
@endsection