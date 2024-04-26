<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'model',
        'price', 'currency',
        'product_image',
        'category_id',
        'customer_id',
        'display_order',
        'display_to',
        'auto_delete_at'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->customer_id = 2;
        });
    }
}
