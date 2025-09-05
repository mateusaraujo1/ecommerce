<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'status', 
        'grand_total', 
        'currency',
        'notes',
        'shipping_amount', 
        'shipping_method', 
        'payment_method', 
        'payment_status'
    ];

    public function order() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function address() {
        return $this->hasOne(Address::class);
    }
}
