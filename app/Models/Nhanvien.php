<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Model
{
    use HasFactory;
    protected $fillable = [
        'mssv',
        'hoten',
        'ngaysinh',
        'gioitinh',
        'sdt',
        'diachi',
        'trangthai',
        'ngayhethan',
    ];
}
