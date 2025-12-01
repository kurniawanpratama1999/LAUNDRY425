<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'code',
        'date',
        'end_date',
        'status',
        'total',
        'payment',
        'change',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pickup()
    {
        return $this->hasOne(Pickup::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
