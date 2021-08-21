<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductSku;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $product_sku;

    public $size_id, $color_id;

    public $quantity;
    public $product_cart_quantity;

    public $price, $promotion_price;

    public function render()
    {
        return view('livewire.product-detail');
    }

    public function mount($slug)
    {
        $data = Product::where('slug', $slug)->first();
        $this->product = $data;
        $this->product_sku = ProductSku::where('product_id', $data->id)->orderBy('size_id', 'asc')->get();

        $default = $data->product_skus->where('default', 1)->first()
        ? $data->product_skus->where('default', 1)->first()
        : $data->product_skus->first();

        $this->color_id = $default->color_id;
        $this->price = $default->price;
        $this->promotion_price = $default->promotion_price;
        $this->quantity = $default->quantity;
        $this->product_cart_quantity = 1;
        $this->getSku();

    }

    public function addCart()
    {
        $size_select = $this->size_id;
        $color_select = $this->color_id;
        $product = $this->product;
        //Kiễm tra - Đã chọn màu sắc và kích thước hay chưa
        if ($size_select && $color_select) {
            // \Cart::add($product, 1, ['size' => 'large']);
            $this->alert('success', 'Thêm ' . $this->product_cart_quantity . ' ' . $product->name) . ' vào giỏ hàng.';
        } else {
            if (!$size_select) {
                $this->alert('info', 'Vui lòng chọn kích thước');
            }
            if (!$color_select) {
                $this->alert('info', 'Vui lòng chọn màu');
            }
        }
    }

    public function selectSize($size_id)
    {
        $this->size_id = $size_id;
        if ($this->color_id) {
            $this->getSku();
        }
    }

    public function selectColor($color_id)
    {
        $this->color_id = $color_id;
        $this->product_sku = "";
        if ($this->size_id) {
            $this->getSku();
        }
        $product_sku = ProductSku::where('product_id', $this->product->id)
            ->where('color_id', $this->color_id)->orderBy('size_id', 'asc')->get();
        $this->product_sku = $product_sku;
    }

    public function getSku()
    {
        $product_sku = $this->product->product_skus
            ->where('size_id', $this->size_id)
            ->where('color_id', $this->color_id)
            ->first();
        if ($product_sku) {
            $this->price = $product_sku->price;
            $this->promotion_price = $product_sku->promotion_price;
            $this->quantity = $product_sku->quantity;
        }
    }
}
