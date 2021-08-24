<div class="flex sm:items-center">

  <div id="notification-list" @click.away="open = false" class="relative flex items-center h-full"
    x-data="{ open: false }">
    <div id="notification-icon relative">
      <button @click="open = !open"
        class="relative p-2 bg-black text-gray-400 transition duration-150 ease-in-out rounded-full hover:text-red-500 focus:outline-none focus:text-red-500 focus:bg-gray-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="svg-inline--fa fa-shopping-cart fa-w-18 text-white w-8 m-auto"
          viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
      </button>
      @if($cartTotal)
      <div
        class="absolute z-30 top-0 right-0 text-xs bg-yellow-300 text-gray-900 font-semibold rounded-full py-1 px-2 transform translate-x-4 -translate-y-3">
        {{$cartTotal}}
      </div>
      @endif
    </div>

    <div x-show="open" x-transition:enter="duration-100 ease-out scale-95"
      x-transition:enter-start="opacity-50 scale-95" x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="transition duration-50 ease-in scale-100" x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
      class="absolute top-0 right-0 max-w-lg mt-16 overflow-hidden origin-top-right transform rounded-lg shadow-lg w-72 sm:w-96"
      style="display: none;">
      <div class="bg-white rounded-md border border-gray-100 shadow-md" role="menu" aria-orientation="vertical"
        aria-labelledby="options-menu">
        <div id="notification-header">
          <div id="notification-head-content"
            class="flex items-center w-full px-3 py-3 text-gray-600 border-b border-gray-200 font-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                clip-rule="evenodd" />
            </svg>
            Giỏ hàng @if($cartTotal)({{$cartTotal}})@endif
          </div>
        </div>
        @if(!$cartTotal)
        <div class="  flex items-center justify-center h-24 w-full text-gray-600 font-medium">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
            </path>
          </svg>
          Trống
        </div>
        @else
        <div class="flex flex-col items-center justify-start h-auto max-h-72 w-full text-black font-medium overflow-auto" style="scroll-behavior: smooth;">
          @foreach($cartContent as $cartItem)
          <div class="p-2">
            <a href="{{route('product.detail',$cartItem->options->slug)}}" class="inline-flex font-normal space-x-1">
              <img class="object-cover object-center w-20 h-auto rounded-sm" src="{{voyager::image($cartItem->options->image)}}"
                alt="">
              <span class="font-primary text-sm">{{$cartItem->name}} <br>
                <span class="text-gray-900 text-md">
                  {{$cartItem->options->color_name}} - {{$cartItem->options->size_name}}
                </span> x {{$cartItem->qty}} : {{number_format($cartItem->price*$cartItem->qty)}}đ
              </span>
            </a>
          </div>
          @endforeach
        </div>        
        <div class="font-semibold text-xl pl-2 justify-center">Tổng đơn hàng: {{$cartTotalPrice}}đ</div>
        @endif
        <div class="relative"></div>

        <div id="notification-footer"
          class="flex items-center justify-center py-3 text-md font-medium text-gray-600 bg-gray-100 border-t border-gray-200 font-primary">
          <a href="{{route('cart.index')}}"><span uk-icon="icon: eye"></span>Xem chi tiết đơn hàng</a>
        </div>

      </div>
    </div>

  </div>
</div>