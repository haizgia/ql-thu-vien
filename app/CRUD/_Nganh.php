<?php

namespace App\CRUD;

use App\Models\Nganh;

class _Nganh {
    public function create($data) {
        try {
            $result = Nganh::create([
                'makhoa' => $data['makhoa'],
                'tennganh' => $data['tennganh'],
            ]);
            if ($result->masach > 0) {
                return 'Add successfuly';
            }
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function getAll()
    {
        try {
            $data = Nganh::select('*')->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    function getByKhoa($makhoa)
    {
        try {
            $data = Nganh::select('*')
            ->where('makhoa', $makhoa)
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id){
        try {
            $data = Nganh::where('nganhs.manganh', '=', $id)->first();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
