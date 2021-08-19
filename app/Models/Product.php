<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['slug', 'name'];
    protected $fillable = ['slug', 'name'];
    protected $table = 'products';
    public $timestamps = true;    

    public function product_skus()
    {
        return $this->hasMany(ProductSku::class,'product_id')->orderBy('color_id', 'desc')->orderBy('size_id', 'asc');
    }

    public function group()
    {
      $collection = ProductSku::where('product_id',$this->id)->groupBy('color_id')
      ->selectRaw('count(*) as total, color_id')
      ->get();
      return $collection;
    }

    public function category()
    {
      return $this->belongsTo(Category::class,'category_id');
    }

    public function product_skus_default()
    {
      $default = $this->product_skus->where('default',1)->first() ? $this->product_skus->where('default',1)->first() : $this->product_skus->first();
      if(!$default){
        $price = "#";
      }
      $price = number_format($default->price);
      if($default->promotion_price){
        $price = number_format($default->promotion_price);
      }
      return $price;
    }

    public function product_promotion_price()
    {
      $default = $this->product_skus->where('default',1) ? $this->product_skus->where('default',1)->first() : $this->product_skus->first();
      return number_format($default->promotion_price);
    }

    public function product_price()
    {
      $default = $this->product_skus->where('default',1) ? $this->product_skus->where('default',1)->first() : $this->product_skus->first();
      return number_format($default->price);
    }
}
