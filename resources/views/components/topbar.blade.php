<div class="border-b border-gray-300 top-0 z-20 bg-black max-w-6x font-normal">
  <div class="flex items-center justify-center md:justify-end mx-auto h-15 md:h-8 max-w-6xl px-4 md:px-0 text-white text-lg">
    <span href="" class="hover:bg-white hover:text-black px-4 hidden lg:block">Hot line: 0909444222 (8h - 12h, 13h30 - 17h) </span>
    <a href="" class="hover:bg-white hover:text-black px-2 hidden md:block md:px-4">Tình trạng đơn hàng </a>
    <div class="pl-0">
      @auth
      <a href="/" class="px-2 hover:bg-white hover:text-black">Chào {{auth()->user()->name}}</a>
      <span>|</span>
      <a href="#" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="px-2 hover:bg-white hover:text-black">Đăng xuất</a>
      <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
      </form>
      @else
      <a href="{{route('login')}}" class="pl-2 pr-1 hover:bg-white hover:text-black">Đăng nhập</a>
      <span>|</span>
      <a href="{{route('register')}}" class="pr-2 pl-1 hover:bg-white hover:text-black">Đăng ký</a>
      @endauth
    </div>
  </div>
</div>