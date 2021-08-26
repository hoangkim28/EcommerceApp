<main class=" min-h-screen">
  <div class="container max-w-5xl mx-auto mb-20 flex flex-col md:flex-row">
    <div class="min-h-80 my-4 sm:my-8 w-full">
      <h1 class="leading-relaxed font-primary font-extrabold text-4xl text-center text-black mt-4 py-2 sm:py-4">
        Giỏ hàng</h1>
      <table class="w-full">
        <thead>
          <tr class="uppercase text-xs sm:text-sm text-black border-b border-gray-500">
            <th class="font-primary font-normal px-0 py-4 max-w-xs">Sản phẩm</th>
            <th class="font-primary font-normal px-0 py-2 lg:py-4">Số lượng</th>
            <th class="font-primary font-normal px-6 py-4 hidden sm:table-cell">Giá</th>
            <th class="font-primary font-normal px-0 py-4">Xóa</th>
          </tr>
        </thead>
        @if($cartTotal)
        <tbody class="divide-y divide-gray-200">
          @foreach($cartContent as $cartItem)
          <tr class="text-sm sm:text-base text-gray-900 text-left">
            <td class="font-primary font-medium px-0 sm:px-6 py-2 flex items-center"><img
                src="{{voyager::image($cartItem['options']['image'])}}" alt="fashion-dog" height="64" width="64"
                class="hidden sm:inline-flex">
              <a class="pt-1 px-2 hover:text-red-500 flex flex-col"
                href="{{route('product.detail',$cartItem['options']['slug'])}}">

                <span class="max-w-xs w-44 md:w-full md:max-w-max">{{$cartItem['name']}}</span>
                <span class="text-red-500 text-md">
                  {{$cartItem['options']['color_name']}} - {{$cartItem['options']['size_name']}}
                </span>
              </a>
            </td>
            <td class="font-primary font-medium px-0 sm:px-6 py-4">
              <livewire:cart-update :item="$cartItem" :key="$cartItem['rowId']" />
            </td>
            <td class="font-primary text-base font-medium px-0 sm:px-6 py-4 hidden sm:table-cell"><span
                class="text-lg">{{number_format($cartItem['price'])}}</span>đ</td>
            <td class="font-primary font-medium px-0 sm:px-6 py-4">
              <livewire:cart-delete-item :rowId="$cartItem['rowId']" />
            </td>
          </tr>
          @endforeach
          <tr class="text-center">
            <td class="hidden lg:block"></td>
            <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">Tổng</td>
            <td class="font-primary text-lg text-red-500 font-medium px-4 sm:px-6 py-4"><span
                class="text-xl">{{\Cart::subtotal();}}</span>đ</td>
            <td class="hidden lg:block"></td>
            <td class="block md:hidden"></td>
          </tr>
        </tbody>
        @else
        <tbody>
          <tr class="text-center">
            <td></td>
            <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">Giỏ hàng trống
            </td>
            <td class="font-primary text-lg text-red-500 font-medium px-4 sm:px-6 py-4"><span class="text-xl">
            <td></td>
          </tr>
        </tbody>
        @endif
      </table>
    </div>
  </div>

  <div class="container max-w-4xl mx-auto mb-20">
    @if(\Cart::count())
    <button wire:click="checkout" class="inline-flex py-4 px-4 bg-red-500 hover:bg-black text-white float-right">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
        <path
          d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
      </svg>
      <span class="text-xl px-4"> Đặt hàng</span>
    </button>
    @else
    <a href="{{route('home')}}" class="inline-flex py-4 px-4 bg-gray-100 hover:bg-gray-300 text-black border border-gray-900 text-center float-right"
          type="button">Tiếp tục mua hàng</a>
    @endif
  </div>
</main>