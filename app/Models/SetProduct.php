<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'set_id',
    ];
}
