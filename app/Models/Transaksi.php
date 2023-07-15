<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
