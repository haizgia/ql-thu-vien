<?php

namespace App\CRUD;

use App\Models\Vitri;

class _Vitri {
    public function create($data) {
        try {
            $result = Vitri::create([
                'tenvt' => $data['tenvt'],
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
            $data = Vitri::select('*')->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
