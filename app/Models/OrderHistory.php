<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model {
  protected $fillable = ['user_id', 'total_harga'];

  // OrderHistory model
  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}