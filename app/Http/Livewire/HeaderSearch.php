<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class HeaderSearch extends Component
{
    public $keyword;

    public $products;

    public function render()
    {
        return view('livewire.header-search');
    }

    public function mount()
    {
      $this->products = '';
    }

    public function search()
    {
      $keyword = $this->keyword;
      $products = Product::where('name', 'like', '%'.$keyword.'%')->first();
      $this->products = $products;
    }
}
