<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductSku;
use App\Models\User;
use Auth;
use Livewire\Component;

class Checkout extends Component
{
  /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var int */
    public $phone_number;

    /** @var string */
    public $address;

    /** @var array */
    protected $usr;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits:10',
        'address' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Vui lòng nhập họ tên.',
        'name.min' => 'Vui lòng nhập đủ họ tên.',
        'phone_number.required' => 'Vui lòng nhập số điện thoại.',
        'phone_number.numeric' => 'Vui lòng nhập số điện thoại là số.',
        'phone_number.digits' => 'Số điện thoại gồm 10 số.',
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Vui lòng nhập đúng email.',
    ];

    public function render()
    {
        return view('livewire.checkout');
    }

    public function mount()
    {
        if (Auth::check()) {
            $usr = User::find(Auth::id());
            $defaultAddress = $usr->getDefaultAddress();
            $this->usr = $usr;
            $this->name = $usr->name;
            $this->email = $usr->email;
            if ($defaultAddress) {
                $this->phone_number = $defaultAddress->phone_number;
                $this->address = $defaultAddress->address;
            }
        }
    }

    public function checkout()
    {
        if (!\Cart::total()) {
            $this->alert('info', 'Không có sản phẩm trong giỏ hàng!');
        }
        $cartContent = \Cart::content();

        if ($this->validate() && \Cart::total()) {
            $order = new Order();
            $order->user_id = Auth::check() ? Auth::id() : '';
            $order->name = $this->name;
            $order->email = $this->email;
            $order->phone_number = $this->phone_number;
            $order->address = $this->address;
            $order->total = intval(\Cart::total());
            $order->subtotal = 2132;
            // dd($order);
            if ($order->save()) {
                foreach ($cartContent as $cartItem) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->sku_id = $cartItem->options->sku_id;
                    $orderDetail->price = $cartItem->price;
                    $orderDetail->quantity = $cartItem->qty;
                    //cập nhật lại số lượng
                    if ($orderDetail->save()) {
                        $sku = ProductSku::find($cartItem->options->sku_id);
                        $new_quantity = $sku->quantity - $cartItem->qty;
                        $sku->update(['quantity' => $new_quantity]);
                    }
                }                
              $this->alert('success', 'Đặt hàng thành công');              
              \Cart::destroy();
            }
        }
    }
}