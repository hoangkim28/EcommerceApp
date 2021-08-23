<main>
  <div class="container max-w-4xl mx-auto mb-20 min-h-screen flex flex-col md:flex-row">
    <div class="min-h-80 my-4 sm:my-8 w-full">
      <h1 class="leading-relaxed font-primary font-extrabold text-4xl text-center text-black mt-4 py-2 sm:py-4">
        Giỏ hàng</h1>
      <table class="w-full">
        <thead>
          <tr class="uppercase text-xs sm:text-sm text-black border-b border-gray-500">
            <th class="font-primary font-normal px-0 py-4 max-w-xs">Sản phẩm</th>
            <th class="font-primary font-normal px-0 py-4">Số lượng</th>
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
              <livewire:cart-update :item="$cartItem" :key="$cartItem['rowId']"/>
            </td>
            <td class="font-primary text-base font-medium px-0 sm:px-6 py-4 hidden sm:table-cell"><span
                class="text-lg">{{number_format($cartItem['price'])}}</span>đ</td>
            <td class="font-primary font-medium px-0 sm:px-6 py-4">
            <livewire:cart-delete-item :rowId="$cartItem['rowId']"/>
            </td>
          </tr>
          @endforeach
          <tr class="text-center">
            <td></td>
            <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">Tổng</td>
            <td class="font-primary text-lg text-red-500 font-medium px-4 sm:px-6 py-4"><span
                class="text-xl">{{\Cart::subtotal();}}</span>đ</td>
            <td></td>
          </tr>
        </tbody>        
        @else
        <tbody>
        <tr class="text-center">
            <td></td>
            <td class="font-primary text-base text-gray-600 font-semibold uppercase px-4 sm:px-6 py-4">Giỏ hàng trống</td>
            <td class="font-primary text-lg text-red-500 font-medium px-4 sm:px-6 py-4"><span
                class="text-xl">
            <td></td>
          </tr>
        </tbody>
        @endif
      </table>
    </div>
  </div>
</main>