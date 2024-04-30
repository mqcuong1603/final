<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['barcode', 'product_name', 'import_price', 'retail_price', 'category'];
}
