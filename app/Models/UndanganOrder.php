<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UndanganOrder extends Model
{
    use HasFactory;
    protected $casts = [
        'gallery' => 'array'
    ];
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
