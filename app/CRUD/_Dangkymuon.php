<?php

namespace App\CRUD;

use App\Models\Dangkymuon;

class _Dangkymuon {
    public function create($data) {
        $result = Dangkymuon::create([
            'mssv' => $data['mssv'],
            'masach' => $data['masach'],
            'ngayhen' => $data['ngayhen'],
        ]);
        try {
            if ($result->masach > 0) {
                return 'Add successfuly';
            }
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function getById($id)
    {
        try {
            $data = Dangkymuon::select('*')
            ->where('dangkymuons.madk', '=', $id)
            ->first();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getAll()
    {
        try {
            $data = Dangkymuon::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'dangkymuons.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'dangkymuons.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'dangkymuons.trangthai')
            ->where('dangkymuons.trangthai', '=', 3)
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearch($col_name, $key)
    {
        $data = Dangkymuon::select('*')
        ->join('chitietsaches', 'chitietsaches.masach', '=', 'dangkymuons.masach')
        ->join('sinhviens', 'sinhviens.mssv', '=', 'dangkymuons.mssv')
        ->join('trangthais', 'trangthais.id', '=', 'dangkymuons.trangthai')
        ->where('dangkymuons.trangthai', '=', 3)
        ->where('dangkymuons.'.$col_name, 'like', "%$key%")
        ->orderBy('dangkymuons.created_at', 'DESC')
        ->paginate(4);
        return $data;
        try {
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByIdUser($id){
        try {
            $data = Dangkymuon::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'dangkymuons.masach')
            ->join('trangthais', 'trangthais.id', '=', 'dangkymuons.trangthai')
            ->where('dangkymuons.mssv', '=', $id)
            // ->where('dangkymuons.trangthai', '=', 3)
            ->orderBy('dangkymuons.created_at', 'DESC')
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByIdUserCheck($id){
        try {
            $data = Dangkymuon::select('*')
            ->where('dangkymuons.trangthai', '=', 3)
            ->where('dangkymuons.mssv', '=', $id)
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByMasachCheck($id){
        try {
            $data = Dangkymuon::select('*')
            ->where('dangkymuons.trangthai', '=', 3)
            ->where('dangkymuons.masach', '=', $id)
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateTrangthai($id, $tt){
        try {
            $data = Dangkymuon::select('*')
            ->where('dangkymuons.madk', $id)
            ->update(['trangthai' => $tt]);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
