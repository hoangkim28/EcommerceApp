<header class="border-b border-gray-200 sticky top-0 z-20 bg-white space-x-6 ">
  <div class="flex items-center justify-between mx-auto max-w-6xl px-6 pb-2 pt-3 md:pt-4">
    <a class=" cursor-pointer" href="/">
      <h1 class="flex no-underline mr-2">
        <img alt="logo" class="h-10 w-10 mr-1 object-contain" src="{{voyager::image(setting('site.logo'))}}">
        <span class="text-xl lg:text-2xl text-black font-primary font-bold tracking-tight pt-1 hidden lg:block">
          {{setting('site.title')}}</span>
      </h1>
    </a>
    @if($categories)
    <div class="space-x-6 hidden md:inline-flex">
      @foreach($categories as $key => $category)
      @if($category->children->count())
      <div x-data="{ dropdown: false }" @mouseenter="dropdown = true" @mouseleave="dropdown=false"
        @click.away="dropdown=false"
        class="relative inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 transition duration-150 ease-in-out border-b-2 border-transparent cursor-pointer hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
        <span class="font-primary text-lg">{{$category->name}}</span>
        <svg class="w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
        <div x-show="dropdown" x-transition:enter="duration-200 ease-out scale-95"
          x-transition:enter-start="opacity-50 scale-95" x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition duration-100 ease-in scale-100"
          x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
          class="absolute top-0 w-screen max-w-xs px-2 mt-20 transform -translate-x-1/2 left-1/2 sm:px-0"
          style="display: none;">
          <div class="border border-gray-100 shadow-md rounded-xl">
            <div class="overflow-hidden shadow-xs rounded-xl">
              <div class="relative z-20 grid gap-6 px-5 py-6 bg-white sm:p-8 sm:gap-8">
                
                  @foreach($category->children as $children)
                  <a href="{{route('product.category',$children->slug)}}"
                    class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out hover:border-blue-500 hover:border-l-2 rounded-xl hover:bg-gray-100">
                    <p class="font-primary font-medium text-lg leading-6 text-gray-900">
                      {{$children->name}}
                    </p>
                  </a>
                  @endforeach
                  
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      <a href="{{route('product.category',$category->slug)}}" class="inline-flex items-center px-1 pt-1 font-primary text-lg leading-5 text-gray-900 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
        {{$category->name}}
      </a>
      @endif
      @if($key == 4)
      @break
      @endif
      @endforeach
    </div>
    @endif

    <div class="space-x-6 inline-flex">
      <div class="p-0">
        @livewire('header-search')
        <div class="flex sm:ml-6 sm:items-center">
          @livewire('header-cart')
        </div>
      </div>
    </div>
</header>