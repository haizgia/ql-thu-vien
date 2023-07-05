<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muontra extends Model
{
    use HasFactory;
    protected $fillable = [
        'mssv',
        'masach',
        'ngaymuon',
        'ngayhentra',
        'ngaytra',
        'ngaygiahan',
        'trangthai',
    ];
    protected $dates = ['ngayhentra', 'ngaytra'];
}
