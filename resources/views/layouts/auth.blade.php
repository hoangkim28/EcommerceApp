@extends('layouts.base')

@section('body')
@include('layouts.nav')
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