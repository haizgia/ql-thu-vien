<?php

namespace App\CRUD;

use App\Models\Savebook;

class _Savebook {
    public function create($data) {
        try {
            $result = Savebook::create($data);
            if ($result->id > 0) {
                return true;
            }
        } catch (\Exception $e) {
            return $e;
        }
        return false;
    }

    public function getByIdUser($id)
    {
        try {
            $data = Savebook::where('id_user', $id)->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id_user, $ms)
    {
        try {
            $data = Savebook::where('id_user', $id_user)
            ->where('masach', $ms)->delete();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id)
    {
        try {
            $data = Savebook::find($id);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
