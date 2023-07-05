<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete

class Sinhvien extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'mssv',
        'hoten',
        'malop',
        'ngaysinh',
        'gioitinh',
        'sdt',
        'diachi',
        'trangthai',
        'ngayhethan',
    ];
}
