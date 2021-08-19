<header class="border-b border-gray-300 sticky top-0 z-20 bg-white">
  <div class="flex items-center justify-between mx-auto max-w-6xl px-6 pb-2 pt-3 md:pt-4">
    <a class=" cursor-pointer"
      href="/">
      <h1 class="flex no-underline">
        <img alt="logo" 
          class="h-8 w-8 mr-1 object-contain"
          src="{{voyager::image(setting('site.logo'))}}">
      <span class="text-xl text-black font-primary font-bold tracking-tight pt-1">
        {{setting('site.title')}}</span>
    </h1>
    </a>
    <a class=" cursor-pointer hidden md:block"
      href="/">
      <h1 class="flex no-underline">
      <span class="text-xl text-white font-primary font-bold tracking-tight pt-1">
        {{setting('site.title')}}</span>
    </h1>
    </a>
    <div class="inline-flex space-x-3">
      <a class=" relative bg-black hover:bg-palette-primary p-1 rounded-md" aria-label="user" href="/login">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-inline--fa fa-w-18 text-white w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
        </svg>
      </a>
      <a class=" relative bg-black hover:bg-palette-primary p-1 rounded-md" aria-label="cart" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-inline--fa fa-shopping-cart fa-w-18 text-white w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
        </svg>
        <div
          class="absolute z-30 top-0 right-0 text-xs bg-yellow-300 text-gray-900 font-semibold rounded-full py-1 px-2 transform translate-x-4 -translate-y-3">
          1</div>
      </a>
    </div>
</header>