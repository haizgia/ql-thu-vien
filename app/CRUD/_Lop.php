<?php

namespace App\CRUD;

use App\Models\Lop;

class _Lop {
    public function getAll()
    {
        try {
            $data = Lop::select('*')->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
