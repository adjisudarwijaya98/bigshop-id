<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receiver_name',
        'receiver_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'total_price',
        'status', // defaultnya 'pending_payment'
    ];

    // Relasi ke order_items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
