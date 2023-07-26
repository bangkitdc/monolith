<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['nama', 'quantity', 'harga'];

    // Define the inverse relationship with OrderHistory model
    public function orderHistory()
    {
        return $this->belongsTo(OrderHistory::class);
    }
}
