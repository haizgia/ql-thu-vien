<?php

namespace App\CRUD;

use App\Models\Loai;

class _Loai {
    public function create($data) {
        try {
            $result = Loai::create([
                'tenloai' => $data['tenloai'],
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
            $data = Loai::select('*')->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id){
        try {
            $data = Loai::select('*')
            ->where('loais.maloai', '=', $id)
            ->first();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
