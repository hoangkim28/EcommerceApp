<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductSku;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $product_sku;
    public $related_product;

    public $size_id, $color_id;
    public $size_name, $color_name;

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
        if(!$data){
          abort('404');
        }
        $this->product = $data;
        $this->related_product = Product::where('category_id', $data->category_id)
            ->orderBy('updated_at', 'asc')->take(4)->get();
        $default = $data->product_skus->where('default', 1)->first()
        ? $data->product_skus->where('default', 1)->first()
        : $data->product_skus->first();

        $this->color_id = $default->color_id;
        $this->price = $default->price;
        $this->promotion_price = $default->promotion_price;
        $this->quantity = $default->quantity;
        $this->product_cart_quantity = 1;
        $this->product_sku = ProductSku::where('product_id', $data->id)->where('color_id', $this->color_id)->orderBy('size_id', 'asc')->get();
    }

    public function addCart()
    {
        $size_select = $this->size_id;
        $color_select = $this->color_id;
        $size_name = $this->size_name;
        $color_name = $this->color_name;
        $product = $this->product;
        //Kiễm tra - Đã chọn màu sắc và kích thước hay chưa
        if ($size_select && $color_select) {
            $cartId = $this->product->id . $color_select . $color_select;
            
            \Cart::add([
              'id' => $cartId,
              'name' => $product->name,
              'qty' => $this->product_cart_quantity,
              'price' => $this->product_order_price(),
              'weight' => 0,
              'options' => [
                  'size' => $size_select,
                  'size_name' => $size_name,
                  'color' => $color_select,
                  'color_name' => $color_name,
                  'image' => $product->image,
                  'slug' => $product->slug,
            ]]);
                
            // listeners - header cart
            $this->emit('updateHeaderCartCount');
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
            $this->size_name = $product_sku->size->name;
            $this->color_name = $product_sku->color->name;
        }
    }
    public function product_order_price()
    {
      $product_order_price = 0;
      if($this->promotion_price){
        $product_order_price = $this->promotion_price;
      }else{
        $product_order_price = $this->price;
      }
      return $product_order_price;
    }
}
