<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_sku',
        'mfg_cost',
        'sales_price',
        'product_qty',
        'product_des',
        'product_img'
    ];
}
