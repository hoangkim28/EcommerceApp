<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Size;
use App\Models\OrderDetail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\SkuRequest;
use Illuminate\Http\Request;
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

        $message_notify = "Cập nhật thành công!";

        $duplicate_check = ProductSku::where(
            ['product_id' => $request->product_id],
            ['color_id' => $request->color_id],
            ['size_id' => $request->size_id])
          ->first();
          
        $sku = ProductSku::find($request->sku_id);
        if($duplicate_check && $request->sku_id == null){
          return redirect()->back()->with([
            'message' => "Sản phẩm này đã tồn tại!",
            'alert-type' => 'info',
            'edit' => 'edit',
          ]);
        }
        
        if (!$sku) {
          $sku = new ProductSku();
          $message_notify = "Thêm thành công!";
        } 
        $default = $request->default;
        $sku->product_id = $request->product_id;
        $sku->color_id = $request->color_id;
        $sku->size_id = $request->size_id;
        $sku->quantity = $request->quantity;
        $sku->price = $request->price;
        $sku->promotion_price = $request->promotion_price;
        $sku->default = $default;

        $sku_list = ProductSku::where('product_id','=',$sku->product_id);
        if($default == 1){
          $sku_list = $sku_list->where('default','=', 1)->where('id','!=',$sku->id)->get();
          if($sku_list->count() >= 1){              
            foreach($sku_list as $sku_item){
              $sku_item->update(['default' => 0]);
            }
          }
        }
        //default = 0
        else{
          $sku_list = $sku_list->where('default','=', 1)->where('id','!=',$sku->id);
          if($sku_list->count() >= 1){
            foreach($sku_list as $sku_item){
              $sku_item->update(['default' => 1]);
            }
          }else{
            $sku->default = 1;
          }
        }
        $sku->save();
        return redirect()->back()->with([
            'message' => $message_notify,
            'alert-type' => 'success',
        ]);
    }

    public function delete_sku(Request $request)
    {
      $status = 0;
      $slug = 'products';
      $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
      // Check permission
      $this->authorize('edit', app($dataType->model_name));
      $id = request()->get('id');
      $sku = ProductSku::find($id);
      $order_check = OrderDetail::where('sku_id','=',$id);
      if(!$order_check->count()){
        if($sku->default == 1){
          $default_sku = ProductSku::where('product_id','=',$sku->product_id)->first();
          if($default_sku){
            $default_sku->default = 1;
            $default_sku->save();
          }
        }
        return 200;
      }else{
        $status = $order_check;
        return 400;
      }
    }
}