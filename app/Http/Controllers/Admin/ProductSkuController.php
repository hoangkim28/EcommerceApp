<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ProductSku;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class ProductSkuController extends BaseController
{
    public function show($id)
    {
      $product = Product::findOrFail($id);
      $product_name = $product->name;
      $skus = $product->product_skus;

      $page_title = "Quản lý sản phẩm con - ".$product_name;
      $view = "voyager::products.sku";
      $sizes = Size::all();
      $colors = Color::all();

      return Voyager::view($view, compact(
        'id',
        'skus',
        'sizes',
        'colors',
        'product_name',
        'page_title',
      ));
    }
}