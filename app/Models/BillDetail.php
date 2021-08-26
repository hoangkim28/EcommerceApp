<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_details';

    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
      'order_id',
      'sku_id',
      'price',
      'quantity'
  ];
}
