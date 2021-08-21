<main>
  <div class="min-h-screen py-12 sm:pt-20">
    <div
      class="flex flex-col justify-center items-center md:flex-row md:items-start space-y-8 md:space-y-0 md:space-x-4 lg:space-x-8 max-w-6xl w-11/12 mx-auto">
      <div class="w-full md:w-1/2 max-w-md border border-palette-lighter bg-white rounded shadow-lg">
        <div class="relative h-96 md:h-112">
          <div
            style="display: block; overflow: hidden; position: absolute; inset: 0px; box-sizing: border-box; margin: 0px;">
            <img alt="test-text" src="{{voyager::image($product->image)}}" decoding="async"
              class="object-cover transform duration-500 ease-in-out hover:scale-105" sizes="100vw"
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
      <div class="flex flex-col justify-between h-full w-full md:w-1/2 max-w-xs mx-auto space-y-4 min-h-128"><a
          aria-label="back-to-products"
          class="border border-black text-black text-lg font-primary font-semibold pt-2 pb-1 leading-relaxed flex  justify-center items-center focus:ring-1 focus:ring-palette-primary focus:outline-none w-full hover:bg-palette-lighter hover:border-palette-primary rounded-sm"
          href="{{str_replace(url('/'), '', url()->previous())}}"><svg aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 w-4 mr-2 inline-flex"
            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor"
              d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z">
            </path>
          </svg>Quay lại</a>
        <div class=" font-primary">
          <h1 class="leading-relaxed font-extrabold text-2xl text-black py-2 sm:py-4">
            {{$product->name}}
          </h1>
          <p class="font-medium text-lg">{{$product->description}}</p>
          <div class="text-xl text-black font-medium py-4 px-1">
            <span
              class="@if($promotion_price) line-through text-xl text-gray-500 @else text-palette-dark text-2xl @endif ">
              {{number_format($price)}}đ</span>
            @if($promotion_price)
            <br>
            <span class="text-3xl text-palette-dark">
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
              <span class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Còn {{$quantity}} sản phẩm</span>
            </div>

            <fieldset class="mt-4">
              <legend class="sr-only">
                Chọn kích thước
              </legend>
              <div class="grid grid-cols-4 gap-4 sm:grid-cols-5 lg:grid-cols-4">

                @foreach($product_sku as $key => $sku)
                <label @if($sku->quantity !== 0)wire:click="selectSize({{$sku->size_id}})" @endif class="group relative
                  border rounded-sm py-3 px-4 sm:py-5 flex items-center justify-center text-xl font-medium
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
          <button wire:click="addCart"
            class="pt-3 pb-2 bg-black text-white w-full mt-2 rounded-sm font-primary font-semibold text-xl flex justify-center items-baseline  hover:bg-palette-dark"
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
      </div>
      <div class="hidden md:block">
      </div>
    </div>
    <div class="max-w-6xl mx-14 mt-6 border md:mx-auto w-8/12">
      @if($product->content)
      <div class="pl-2 font-primary">
        <h1 class="leading-relaxed font-extrabold text-2xl text-black py-2 sm:py-4">
          Thông tin sản phẩm
        </h1>
        {!! $product->content !!}
      </div>
      @else
      <p class="pl-4 py-2 sm:py-4 text-center">Chưa có mô tả cho sản phẩm này</p>
      @endif
    </div>
  </div>
</main>