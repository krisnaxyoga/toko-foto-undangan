<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    public function categorypackage()
    {
        return $this->belongsTo(Categorypackage::class, 'category_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
