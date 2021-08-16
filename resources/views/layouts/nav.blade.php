<header class="border-b border-palette-lighter sticky top-0 z-20 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500">
  <div class="flex items-center justify-between mx-auto max-w-6xl px-6 pb-2 pt-3 md:pt-4">
    <a class=" cursor-pointer"
      href="/">
      <h1 class="flex no-underline">
        <img alt="logo" 
          class="h-8 w-8 mr-1 object-contain"
          src="{{voyager::image(setting('site.logo'))}}">
      <span class="text-xl text-white font-primary font-bold tracking-tight pt-1">
        {{setting('site.title')}}</span>
    </h1>
    </a>
    <a class=" cursor-pointer"
      href="/">
      <h1 class="flex no-underline">
      <span class="text-xl text-white font-primary font-bold tracking-tight pt-1">
        {{setting('site.title')}}</span>
    </h1>
    </a>
    <div>
      <a class=" relative" aria-label="cart" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-inline--fa fa-shopping-cart fa-w-18 text-palette-primary w-6 m-auto" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
        </svg>
        <div
          class="absolute top-0 right-0 text-xs bg-yellow-300 text-gray-900 font-semibold rounded-full py-1 px-2 transform translate-x-10 -translate-y-3">
          1</div>
      </a>
    </div>
    <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
  </div>
  
</header>