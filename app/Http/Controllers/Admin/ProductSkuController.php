<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Size;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\SkuRequest;
use Illuminate\Routing\Controller as BaseController;
use TCG\Voyager\Facades\Voyager;

class ProductSkuController extends BaseController
{
    use AuthorizesRequests;

    public function show($id)
    {
        $slug = 'products';
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $product = Product::findOrFail($id);
        $product_name = $product->name;
        $skus = $product->product_skus;

        $page_title = "Quản lý sản phẩm con - " . $product_name;
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

    public function get_sku($id)
    {
        $this->authorize('read', app('App\Models\Product'));
        return response()->json([
          'sku' => ProductSku::find($id)
      ]);
    }

    public function store(SkuRequest $request)
    {
        $slug = 'products';
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $sku = ProductSku::find($request->sku_id);
        if (!$sku) {
          $sku = new ProductSku();
        }
        $default = 0;
        if($request->default = '1'){
          $default = 1;
        }
        $sku->product_id = $request->product_id;
        $sku->color_id = $request->color_id;
        $sku->size_id = $request->size_id;
        $sku->quantity = $request->quantity;
        $sku->price = $request->price;
        $sku->promotion_price = $request->promotion_price;
        $sku->default = $default;

        $sku_list = ProductSku::where('product_id','=',$request->product_id);          
        if($default == '1'){
          $sku_list = $sku_list->where('default', 1)->get();
          foreach($sku_list as $item){
            $item->default = 0;
            $item->save();
          }
        }else{
          $sku_default = $sku_list->first();
          $sku_default->default = 1;
          $sku_default->save();
        }
        $sku->save();
        $sku_list = ProductSku::where('product_id','=',$request->product_id);
        $sku_default_list = $sku_list->where('default', 1);
        if(!$sku_default_list->count()){
          $sku_default = $sku_list->first();
          $sku_default->default = 1;
          $sku_default->save();
        }
        return redirect()->back()->with([
            'message' => "Thêm mới sản phẩm con thành công!",
            'alert-type' => 'success',
        ]);
    }
}