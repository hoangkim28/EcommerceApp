<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $table = 'product_skus';
    protected $fillable = ['default','price','promotion_price'];
    public $timestamps = false;
    use HasFactory;
    public function price()
    {
      $this->price;
    }

    public function color()
    {
      return $this->belongsTo(Color::class,'color_id');
    }

    public function size()
    {
      return $this->belongsTo(Size::class,'size_id');
    }

    public function product()
    {
      return $this->belongsTo(Product::class,'product_id');
    }
}
