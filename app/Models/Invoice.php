<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'description',
        'category',
        'status',
        'user_id',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
