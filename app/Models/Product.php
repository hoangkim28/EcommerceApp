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

    public function category()
    {
      return $this->belongsTo(Category::class,'category_id');
    }

    public function product_skus_default()
    {
      $default = $this->product_skus->where('default',1) ? $this->product_skus->where('default',1) : $this->product_skus->first();
      if(!$default){
        $price = "#";
      }
      foreach($default as $sku)
      {
        $price = number_format($sku->price);
        if($sku->promotion_price){
          $price = number_format($sku->promotion_price);
        }
      }
      return $price;
    }
    public function product_skus_default_promotion()
    {
      $default = $this->product_skus->where('default',1) ? $this->product_skus->where('default',1) : $this->product_skus->first();
      if(!$default){
        return false;
      }
      foreach($default as $sku)
      {
        if($sku->promotion_price){
          return true;
        }
      }
      return false;
    }
}
