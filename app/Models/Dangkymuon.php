<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dangkymuon extends Model
{
    use HasFactory;
    protected $fillable = [
        'mssv',
        'masach',
        'ngayhen',
        'trangthai',
    ];
}
