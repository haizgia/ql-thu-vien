<?php

namespace App\CRUD;

use App\Models\Sach;
use App\Models\Muontra;
use App\Models\Vipham;
// nếu dùng slug thì dùng thư viện
// use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _Muontra {
    public function create($data) {
        $result = Muontra::create([
            'mssv' => $data['mssv'],
            'masach' => $data['masach'],
            'ngaymuon' => $data['ngaymuon'],
            'ngayhentra' => $data['ngayhentra'],
        ]);
        if ($result->id > 0) {
            return $result;
        }
        return false;
        try {
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }

    public function update($data, $id) {
        try {
            $result = Muontra::where('masach','=',$id)
            ->update([
                'manganh' => $data['manganh'],
                'maloai' => $data['maloai'],
                'mavt' => $data['mavt'],
                'tinhtrang' => $data['tinhtrang'],
                'soluong' => $data['soluong'],
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
            $result = Muontra::where('masach', '=', $id)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deleteMulti($ids) {
        try {
            $result = Muontra::whereIn('masach', $ids)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getOneNew(){
        $data = Muontra::select('*')
        ->orderBy('masach', 'DESC')
        ->limit(1)
        ->get();
        return $data;
    }

    public function getLending()
    {
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->where('muontras.trangthai', '=', 6)
            ->orderBy('maphieu', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getOutOfDate()
    {
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->whereIn('muontras.trangthai', [8, 9, 11])
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getLendingSearch($col_name, $key)
    {
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->where('muontras.trangthai', '=', 6)
            ->where('muontras.'.$col_name, 'like', "%$key%")
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getOutOfDateSearch($col_name, $key)
    {
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->whereIn('muontras.trangthai', [8, 9, 11])
            ->where('muontras.'.$col_name, 'like', "%$key%")
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id){
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            // ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->where('muontras.maphieu', '=', $id)
            ->first();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByIdUser($id){
        try {
            $data = Muontra::select('*')
            ->join('chitietsaches', 'muontras.masach', '=', 'chitietsaches.masach')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->where('muontras.mssv', '=', $id)
            ->orderBy('muontras.created_at', 'DESC')
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByIdUserCheck($id){
        try {
            $data = Muontra::select('*')
            ->where('muontras.trangthai', '=', 6)
            ->where('muontras.mssv', '=', $id)
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByMasachCheck($id){
        try {
            $data = Muontra::select('*')
            ->where('muontras.trangthai', '=', 6)
            ->where('muontras.masach', '=', $id)
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateTrangthai($id, $tt){
        try {
            $data = Muontra::select('*')
            ->where('muontras.maphieu', $id)
            ->update(['trangthai' => $tt]);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function renewal($id, $date){
        try {
            $data = Muontra::select('*')
            ->where('muontras.maphieu', $id)
            ->update(['ngayhentra' => $date]);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function vipham($id, $data)
    {
        // dd($data);
        $result = Vipham::create($data);
        if ($result->maphieu > 0) {
            return true;
        }
        return false;
        try {
        } catch (\Exception $e) {
            return $e;
        }
        return 'ERROR';
    }


    public function exportOutOfDate()
    {
        try {
            $data = Muontra::select("muontras.maphieu as Mã phiếu","sinhviens.mssv as Mssv", "muontras.masach as Mã sách",
            "sinhviens.hoten as Họ và tên","trangthais.tentt as Trạng thái")
            ->join('chitietsaches', 'chitietsaches.masach', '=', 'muontras.masach')
            ->join('sinhviens', 'sinhviens.mssv', '=', 'muontras.mssv')
            ->join('trangthais', 'trangthais.id', '=', 'muontras.trangthai')
            ->whereIn('muontras.trangthai', [8, 9, 11])
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
