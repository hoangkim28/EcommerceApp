<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cartTotal;
    public $cartTotalPrice;

    public $cartContent;

    protected $listeners = ['updateCartContent' => 'updateCartContent'];
    
    public function render()
    {
        return view('livewire.cart');
    }

    public function mount()
    {
        $this->cartTotal = \Cart::count();
        $this->cartContent = \Cart::content()->toArray();
        $this->cartTotalPrice = \Cart::priceTotal();
    }

    public function updateCartContent()
    {
      $this->cartTotal = \Cart::count();
      $this->cartContent = \Cart::content()->toArray();
      $this->cartTotalPrice = \Cart::priceTotal();
    }

    public function checkout()
    {
      return redirect()->route('checkout');
    }
}
