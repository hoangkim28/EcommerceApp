<div class="bg-white hidden sm:flex items-center rounded-none max-w-xs">
  <input wire:model="keyword" value="{{$keyword}}" wire:change="search()" class="h-12 w-full px-8 text-black leading-tight border-2 focus:border-2 focus:border-white border-black rounded-none" id="search" type="text"
    placeholder="Từ khóa...">
  <button
    class="bg-black text-white rounded-none p-3 ml-0 focus:outline-none w-14 h-12 flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
  </button>
</div>
</div>

{{$products}}