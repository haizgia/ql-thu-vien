<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savebook extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'masach',
    ];
}
