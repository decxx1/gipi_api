<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
