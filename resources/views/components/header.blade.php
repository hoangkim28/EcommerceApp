<header class="border-b border-gray-200 sticky top-0 z-20 bg-white">
  <div class="flex items-center justify-between mx-auto max-w-6xl px-6 pb-2 pt-3 md:pt-4">
    <a class=" cursor-pointer" href="/">
      <h1 class="flex no-underline">
        <img alt="logo" class="h-8 w-8 mr-1 object-contain" src="{{voyager::image(setting('site.logo'))}}">
        <span class="text-xl text-black font-primary font-bold tracking-tight pt-1">
          {{setting('site.title')}}</span>
      </h1>
    </a>

    <div class="space-x-6 inline-flex">
      <div class="p-0">
        @livewire('header-search')
        <div class="flex sm:ml-6 sm:items-center">
          @livewire('header-cart')
        </div>
      </div>
    </div>

</header>