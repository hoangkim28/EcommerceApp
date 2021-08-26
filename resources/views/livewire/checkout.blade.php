<main class=" min-h-screen px-4 py-6 md:py-14 mx-auto max-w-6xl">
  <h2 class="md-0 md:mb-4 text-xl font-bold md:text-3xl text-black">Thông tin nhận hàng</h2>
  <form wire:submit.prevent="checkout" class="grid grid-cols-1 gap-0 text-gray-600 md:grid-cols-2 md:gap-16">
    <div class="space-y-0 mt-10">
      <div class="py-2 space-y-2">
        <label class="font-semibold text-gray-900">Họ và tên</label>
        <input wire:model.lazy="name" type="text" class="py-3 px-4 w-full border border-gray-300">
        @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div class="flex flex-col md:flex-row">
        <div class="py-2 space-y-2">
          <label for="email" class="font-semibold text-gray-900">Email</label>
          <input wire:model.lazy="email" type="email" class="py-3 px-4 w-full border border-gray-300">
          @error('email') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="py-2 space-y-2 ml-0 md:ml-4">
          <label for="phone_number" class="font-semibold text-gray-900">Điện thoại</label>
          <input wire:model.lazy="phone_number" type="number" class="py-3 px-4 w-full border border-gray-300">
          @error('phone_number') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="py-2 space-y-2">
        <label for="address" class="font-semibold text-gray-900">Địa chỉ</label>
        <textarea wire:model.lazy="address" type="text" class="py-3 px-4 w-full border border-gray-300"
          row="6"></textarea>
          @error('address') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
      </div>
    </div>
    <div class=" mt-10">
      <h2 class="mb-4 text-xl font-bold md:text-2xl text-black">@if(\Cart::count()) Thông tin nhận hàng @else Giỏ hàng trống @endif</h2>
      @foreach(\Cart::content() as $cartItem)
      <div class="flex flex-row space-x-2 max-h-32 mb-4">
        <img class="w-12 max-h-12 object-cover object-center" src="{{voyager::image($cartItem->options->image)}}"
          alt="">
        <a class="flex flex-col flex-grow" class="" href="">
          {{$cartItem->name}} : {{number_format($cartItem->price)}}đ x{{$cartItem->qty}}
        </a>
        <span class="text-gray-900">{{$cartItem->total()}}đ</span>
      </div>
      @endforeach
      @if(\Cart::count())
      <div class="text-right">
        <h2 class="text-red-500 py-4 text-2xl">Tổng đơn hàng: {{\Cart::total()}}đ</h2>
      </div>
      @endif
      <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
        <a href="{{route('home')}}" class="flex-1 px-12 py-3 bg-gray-100 hover:bg-gray-300 text-black border border-gray-900 text-center"
          type="button">Tiếp tục mua hàng</a>
        @if(\Cart::total())
        <button class="flex-1 px-12 py-3 bg-red-500 hover:bg-black text-white" type="submit">Đặt hàng</button>
        @endif
      </div>
    </div>
  </form>
</main>