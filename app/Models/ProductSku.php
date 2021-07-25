<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $table = 'product_skus';
    public $timestamps = false;
    use HasFactory;

    public function colors()
    {
      return $this->hasMany(Color::class);
    }

    public function sizes()
    {
      return $this->hasMany(Size::class);
    }
}
