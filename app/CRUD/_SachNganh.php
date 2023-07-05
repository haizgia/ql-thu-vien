<?php

namespace App\CRUD;

use App\Models\Sach_nganh;
use App\Models\Chitietsach;
// nếu dùng slug thì dùng thư viện
// use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _SachNganh {
    public function create($masach, $manganh) {
        try {
            $result = Sach_nganh::create([
                'masach' => $masach,
                'manganh' => $manganh,
            ]);
            if ($result->id > 0) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }



    public function destroy($id)
    {
        try {
            $result = Sach_nganh::withTrashed()
            ->where('masach', '=', $id)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy_multi($ids)
    {
        try {
            $result = Sach_nganh::withTrashed()
            ->whereIn('masach', $ids)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
