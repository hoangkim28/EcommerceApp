<main>
  <div class="min-h-screen py-12 sm:pt-20">
    <div
      class="flex flex-col justify-center items-center md:flex-row md:items-start space-y-8 md:space-y-0 md:space-x-4 lg:space-x-8 max-w-6xl w-11/12 mx-auto">
      <div class="w-full md:w-1/2 lg:w-2/5  max-w-md border border-palette-lighter bg-white rounded shadow-lg">
        <div class="relative h-72 md:h-112">
          <div
            style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
            <img alt="test-text" src="{{voyager::image($product->image)}}" decoding="async"
              class="object-cover object-center transform duration-500 ease-in-out hover:scale-105" sizes="100vw"
              srcset="{{voyager::image($product->image)}}"
              style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
          </div>
        </div>
        @if($product->more_image)
        <div class="relative flex border-t border-gray-200">
          <div class="flex space-x-1 w-full overflow-auto border-t border-palette-lighter"
            style="scroll-behavior: smooth;">
            @foreach(json_decode($product->more_image) as $image)
            <button class="relative w-40 h-32 flex-shrink-0 rounded-sm ">
              <div
                style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
                <img alt="test-text" src="{{voyager::image($image)}}" decoding="async" class="" sizes="100vw"
                  srcset="{{voyager::image($image)}}"
                  style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
              </div>
            </button>
            @endforeach
          </div>
        </div>
        @endif
      </div>
      <div class="flex flex-col justify-between h-full w-full md:w-1/2 lg:w-3/5 max-w-xl mx-auto space-y-4 min-h-128">
        <div class=" font-primary">
          <a class="text-black text-xl font-primary font-semibold leading-relaxed underline"
            href="/">{{$product->category->name}}</a>
          <h1 class="leading-relaxed font-extrabold text-2xl text-black py-2 sm:py-4">
            {{$product->name}}
          </h1>
          <div class="text-xl text-black font-medium py-4 px-1">
            <span class="@if($promotion_price) line-through text-xl text-gray-500 @else text-red-500 text-2xl @endif ">
              {{number_format($price)}}đ</span>
            @if($promotion_price)
            <br>
            <span class="text-3xl text-red-500">
              {{number_format($promotion_price)}}đ
            </span>
            @endif
          </div>
        </div>
        <div class="w-full">
          <!-- Colors -->
          <div>
            <h3 class="text-lg text-gray-900 font-primary">Màu sắc:</h3>
            <fieldset class="mt-4">
              <legend class="sr-only">
                Choose a color
              </legend>
              <div class="grid grid-cols-4 gap-6 sm:grid-cols-4">
                @foreach($product->group() as $key => $color)
                <label wire:click="selectColor({{$color->color_id}})" class="-m-0.5 relative p-0.5 flex items-center justify-center cursor-pointer focus:outline-none rounded-sm
              @if($color->color_id === $color_id) bg-black text-white @else bg-gray-50 text-black @endif
              ">
                  <span aria-hidden="true" class="h-8 px-1 py-1">{{$color->color->name}}</span>
                </label>
                @endforeach
              </div>
            </fieldset>
          </div>

          <!-- Sizes -->
          <div class="mt-4">
            <div class="flex items-center justify-between">
              <h3 class="text-lg text-gray-900 font-primary">Kích thước</h3>
              <span class="text-lg font-medium text-indigo-600 hover:text-indigo-500">Còn {{$quantity}} sản phẩm</span>
            </div>

            <fieldset class="mt-4">
              <legend class="sr-only">
                Chọn kích thước
              </legend>
              <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">

                @foreach($product_sku as $key => $sku)
                <label @if($sku->quantity !== 0)wire:click="selectSize({{$sku->size_id}})" @endif class="group relative
                  border rounded-sm py-1 px-1 md:px-1 sm:py-3 flex items-center justify-center text-xl font-medium
                  focus:outline-none sm:flex-1 hover:text-white font-primary
                  @if($sku->quantity === 0) cursor-not-allowed @else cursor-pointer hover:bg-black hover:border-black
                  @endif
                  @if($sku->size_id === $size_id) bg-black text-white @else bg-gray-50 text-black @endif
                  ">
                  {{$sku->size->name}}
                  @if($sku->quantity === 0)
                  <div aria-hidden="true"
                    class="absolute -inset-px rounded-md border-2 border-gray-400 pointer-events-none">
                    <svg class="absolute inset-0 w-full h-full text-gray-400 stroke-2" viewBox="0 0 100 100"
                      preserveAspectRatio="none" stroke="currentColor">
                      <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                    </svg>
                  </div>
                  @else
                  <div class="absolute -inset-px rounded-md pointer-events-none" aria-hidden="true"></div>
                  @endif
                </label>
                @endforeach

              </div>
            </fieldset>
          </div>
        </div>
        <div class="w-full">
          <div class="flex justify-start space-x-2 w-full">
            <div class="flex flex-col items-start space-y-1 flex-grow-0">
              <h3 class="text-lg text-gray-900 font-primary">Số lượng</h3>
              <input wire:model="product_cart_quantity" type="number" inputmode="numeric" id="quantity" name="quantity"
                min="1" step="1"
                class="text-gray-900 form-input border border-gray-300 w-24 rounded-sm focus:border-palette-primary focus:ring-palette-primary"
                value="1">
            </div>
          </div>
        </div>
        <div class="w-full">
          <div class="flex flex-row space-x-1 md:space-x-6">
            <button wire:click="addCart" @if($quantity === 0) disabled @endif
              class="cursor-pointer pt-3 pb-2 bg-red-500 text-white w-full md:w-1/2 mt-2 rounded-sm font-primary font-semibold text-xl flex justify-center items-center hover:bg-black @if($quantity === 0) cursor-not-allowed @else cursor-pointer hover:bg-black hover:border-black @endif"
              aria-label="cart-button">
              Thêm giỏ hàng
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart"
                class="svg-inline--fa fa-shopping-cart fa-w-18 w-5 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512">
                <path fill="currentColor"
                  d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z">
                </path>
              </svg>
            </button>
          </div>

            <div wire:loading wire:target="addCart" class="text-black animate-pulse py-2 text-red-500 text-lg">
                Đang thêm vào giỏ hàng...
            </div>
        </div>
      </div>
    </div>

    <div class="max-w-6xl mx-auto px-2 mt-6 pb-4 border w-72 sm:w-96 md:w-8/12">
      @if($product->content)
      <div class="pl-2 font-primary">
        <h1 class="leading-relaxed font-extrabold text-2xl text-black py-2 sm:py-4">
          Thông tin sản phẩm
        </h1>
        {!! $product->content !!}
      </div>
      @else
      <p class="py-1 sm:py-4 text-center">Chưa có mô tả cho sản phẩm này</p>
      @endif
    </div>
  </div>
  @if($related_product)
  <div class="py-6 max-w-6xl mx-auto">
    <div class="inline-flex items-center py-4 ml-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
        <path
          d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
      </svg>
      <p class="text-2xl px-2 py-2 font-bold">
        Các sản phẩm liên quan
      </p>
    </div>
    <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
      @foreach($related_product as $product)
      <a class="h-120 w-72 sm:w-96 md:w-64 rounded shadow-lg mx-auto border border-palette-lighter"
        href="{{route('product.detail',$product->slug)}}">
        <div class="h-72 border-b-2 border-palette-lighter relative">
          <div
            style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
            <img alt="test-text" src="{{voyager::image($product->image)}}" decoding="async"
              class="transform duration-500 ease-in-out hover:scale-110"
              style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
              sizes="100vw" srcset="{{voyager::image($product->image)}}">
          </div>
        </div>
        <div class="h-48 relative">
          <div class="font-primary text-black text-xl pt-4 px-4 font-semibold line-clamp-4">
            {{$product->name}}
          </div>
          <div class="text-lg text-gray-600 p-4 font-primary font-light">
            {{$product->category->name}}
          </div>
          <div
            class="text-red-500 font-primary font-medium text-base absolute bottom-0 right-0 mb-4 pl-8 pr-4 pb-1 pt-2 bg-palette-lighter rounded-tl-sm triangle transform duration-500 ease-in-out hover:scale-125">
            <span class="text-lg">
              {{$product->product_skus_default()}}đ
            </span>
          </div>
        </div>
      </a>
      @endforeach
    </div>

  </div>
  @endif
</main>
