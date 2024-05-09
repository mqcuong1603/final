<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['barcode', 'product_name', 'import_price', 'retail_price', 'category', 'creation_date', 'created_at', 'updated_at'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    
}
