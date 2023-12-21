<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_name',
        'customer_number',
        'customer_address',
        'Product_id',
        'sales_qty',
    ];
}
