<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vipham extends Model
{
    use HasFactory;
    protected $fillable = [
        'maphieu',
        'ndvipham',
        'htxuphat',
    ];
}
