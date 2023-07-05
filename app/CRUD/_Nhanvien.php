<?php

namespace App\CRUD;

use App\Models\Nhanvien;
// nếu dùng slug thì dùng thư viện
// use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _Nhanvien {
    public function getSearch($col_name, $key)
    {
        try {
            $data = Nhanvien::select('*')
            ->where($col_name, 'like', "%$key%")
            ->orderBy('mssv', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
