<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'brand',
        'provider',
        'image',
        'code',
        'description',
        'price_purchase',
        'price_sale',
        'price_wholesale',
        'term',
        'shipping',
        'warranty',
        'check_percentage',
        'percentage',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    public function images()
    {
        return $this->belongsTo(Image::class);
    }
}
