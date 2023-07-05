<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chitietsach extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'masach',
        'ten',
        'tacgia',
        'nxb',
        'mota',
        'hinhanh',
        'slug',
        'index',
        'display',
        'link-pdf',
    ];
}
