<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeaderCart extends Component
{
    /** @var int */
    public $cartTotal;

    /** @var int */
    public $cartTotalPrice;

/** @var array */
    public $cartContent;

    protected $listeners = ['updateHeaderCartCount' => 'updateCartCount'];

    public function render()
    {
        return view('livewire.header-cart');
    }

    public function mount()
    {
        $this->cartTotal = \Cart::count();
        $this->cartContent = \Cart::content();
        $this->cartTotalPrice = \Cart::priceTotal();
    }

    public function updateCartCount()
    {
        $this->cartTotal = \Cart::count();
        $this->cartContent = \Cart::content();
        $this->cartTotalPrice = \Cart::priceTotal();
    }
}
