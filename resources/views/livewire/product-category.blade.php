<main>
  <div class="mx-auto max-w-7xl">
    <div class="">
      <h1
        class="leading-relaxed font-primary font-extrabold text-4xl text-center text-black mt-4 py-2 sm:py-4">
        {{$category->name}}</h1>
    </div>
    @if($products->count())
    <div class="py-12 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8">
      @foreach($products as $product)
      <a class="h-120 w-72 sm:w-96 md:w-64 rounded shadow-lg mx-auto border border-palette-lighter" href="{{route('product.detail',$product->slug)}}">
        <div class="h-72 border-b-2 border-palette-lighter relative">
          <div
            style="display:block;overflow:hidden;position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;margin:0">
            <img alt="test-text"
              src="{{voyager::image($product->image)}}"
              decoding="async" class="transform duration-500 ease-in-out hover:scale-110"
              style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
              sizes="100vw"
              srcset="{{voyager::image($product->image)}}">
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
    @else
    <p class="py-2 my-10 max-w-6xl mx-auto text-xl">Hiện chưa có sản phẩm thuộc danh mục này.</p>
    @endif
      {{ $products->links() }}
  </div>
</main>