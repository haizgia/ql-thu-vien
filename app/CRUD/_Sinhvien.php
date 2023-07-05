<?php

namespace App\CRUD;

use App\Models\Sinhvien;
// nếu dùng slug thì dùng thư viện
// use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _Sinhvien {
    public function create($data) {
        try {
            $result = Sinhvien::create([
                'mssv' => $data['mssv'],
                'hoten' => $data['ten'],
                'malop' => $data['malop'],
                'ngaysinh' => $data['ngaysinh'],
                'gioitinh' => $data['gioitinh'],
                'sdt' => $data['sdt'],
                'diachi' => $data['diachi'],
                'trangthai' => 0,
                'ngayhethan' => $data['ngayhethan'],
            ]);
            if ($result->mssv > 0) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function update($data, $id) {
        try {
            $result = Sinhvien::where('mssv','=',$id)
            ->update([
                'hoten' => $data['ten'],
                'malop' => $data['malop'],
                'ngaysinh' => $data['ngaysinh'],
                'gioitinh' => $data['gioitinh'],
                'sdt' => $data['sdt'],
                'diachi' => $data['diachi'],
                'trangthai' => 0,
                'ngayhethan' => $data['ngayhethan'],
            ]);
            if ($result) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function delete($id) {
        try {
            $result = Sinhvien::where('mssv', '=', $id)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deleteMulti($ids) {
        try {
            $result = Sinhvien::whereIn('mssv', $ids)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getOneNew(){
        $data = Sinhvien::select('*')
        ->orderBy('mssv', 'DESC')
        ->limit(1)
        ->get();
        return $data;
    }

    public function getNew()
    {
        try {
            $data = Sinhvien::select('*')
            ->join('lops', 'lops.malop', '=', 'sinhviens.malop')
            ->orderBy('Sinhviens.mssv', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearch($col_name, $key)
    {
        try {
            $data = Sinhvien::select('*')
            ->join('lops', 'lops.malop', '=', 'sinhviens.malop')
            ->where($col_name, 'like', "%$key%")
            ->orderBy('mssv', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id){
        try {
            $data = Sinhvien::select('*')
            ->join('lops', 'lops.malop', '=', 'sinhviens.malop')
            ->where('sinhviens.mssv', '=', $id)
            ->get();
            return $data[0];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
