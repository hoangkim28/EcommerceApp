<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartUpdate extends Component
{
    /** @var array */
    public $cartItem = [];

    /** @var int */
    public $quantity = 1;

    public function mount($item)
    {
        $this->cartItem = $item;
        $this->quantity = $item['qty'];
    }

    public function render()
    {
        return view('livewire.cart-update');
    }

    public function plus()
    {
        $this->quantity++;
        \Cart::update($this->cartItem['rowId'], $this->quantity);
        $this->emit('cartUpdated');
        $this->emit('updateHeaderCartCount');
        $this->emit('updateCartContent');

    }

    public function minus()
    {
        $this->quantity--;
        \Cart::update($this->cartItem['rowId'], $this->quantity);
        $this->emit('cartUpdated');
        $this->emit('updateHeaderCartCount');
        $this->emit('updateCartContent');

    }
}
