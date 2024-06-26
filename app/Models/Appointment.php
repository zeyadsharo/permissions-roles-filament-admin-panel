<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
     protected $fillable = ['private_label', 'public_label', 'start_date', 'end_date', 'auto_delete_at', 'color', 'customer_id', 'is_private'];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'auto_delete_at' => 'datetime'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // add observer to set customer_id on create 
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->customer_id = auth()->user()->customer->id;
        });
        static::addGlobalScope('customer', function (Builder $builder) {
            $builder->where('customer_id', auth()->user()->customer->id);
        });
    }
    
}
