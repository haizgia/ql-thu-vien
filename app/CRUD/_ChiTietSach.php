<?php

namespace App\CRUD;

use App\Models\ChiTietSach;
// nếu dùng slug thì dùng thư viện
use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _Chitietsach {
    public function create($data) {
        try {
            $result = Chitietsach::create([
                'masach' => $data['masach'],
                'ten' => $data['ten'],
                'tacgia' => $data['tacgia'],
                'nxb' => $data['nxb'],
                'mota' => $data['mota'],
                'hinhanh' => $data['hinhanh'],
                'slug' => Str::slug($data['ten']),
                'index' => $data['index'],
                'display' => $data['display'],
                'link-pdf' => $data['link-pdf'],
            ]);
            if ($result->masach > 0) {
                return 'true';
            }
            return false;
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function update($data, $id) {
        try {
            // dd($data['ten']);

            $result = Chitietsach::where('masach', '=', $id)
            ->update([
                'ten' => $data['ten'],
                'tacgia' => $data['tacgia'],
                'nxb' => $data['nxb'],
                'mota' => $data['mota'],
                'hinhanh' => $data['hinhanh'],
                'slug' => Str::slug($data['ten']),
                'index' => $data['index'],
                'display' => $data['display'],
                'link-pdf' => $data['link-pdf'],
            ]);
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function delete($id) {

        try {
            $result = Chitietsach::where('masach', '=', $id)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deleteMulti($ids) {
        try {
            $result = Chitietsach::whereIn('masach', $ids)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getAll()
    {
        try {
            $data = Chitietsach::select('*')->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function restore($id)
    {
        try {
            $result = Chitietsach::withTrashed()
            ->where('masach', '=', $id)->restore();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function restore_multi($ids)
    {
        try {
            $result = Chitietsach::withTrashed()
            ->whereIn('masach', $ids)->restore();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy($id)
    {
        try {
            $result = Chitietsach::withTrashed()
            ->where('masach', '=', $id)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy_multi($ids)
    {
        try {
            $result = Chitietsach::withTrashed()
            ->whereIn('masach', $ids)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
