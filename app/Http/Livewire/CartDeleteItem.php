<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartDeleteItem extends Component
{
    public $rowId = [];

    protected $listeners = [
      'confirmed_delete'
  ];

    public function render()
    {
        return view('livewire.cart-delete-item');
    }

    public function mount($rowId)
    {
      $this->rowId = $rowId;
    }

    public function remove()
    {
      $cartItem = \Cart::get($this->rowId);
      $this->confirm('Xác nhận xóa '.$cartItem->name, [
        'toast' => false,
        'position' => 'center',
        'showConfirmButton' => true,
        'cancelButtonText' => 'Nope',
        'onConfirmed' => 'confirmed_delete',
        'onCancelled' => 'cancelled'
      ]);
    }
    public function confirmed_delete()
    {      
      \Cart::remove($this->rowId);
      $this->emit('updateHeaderCartCount');
      $this->emit('updateCartContent');
    }
}
