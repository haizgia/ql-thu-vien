<?php

namespace App\CRUD;

use App\Models\Sach;
use App\Models\Chitietsach;
use DB;
// nếu dùng slug thì dùng thư viện
// use Illuminate\Support\Str;
// 'slug' => Str::slug($data['slug'])

class _Sach {
    public function create($data) {
        try {
            $result = Sach::create([
                'manganh' => $data['manganh'],
                'maloai' => $data['maloai'],
                'mavt' => $data['mavt'],
                'tinhtrang' => $data['tinhtrang'],
                'soluong' => $data['soluong'],
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

    public function update($data, $id) {
        try {
            $result = Sach::where('masach','=',$id)
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

    public function updateLendBook($id, $sl) {
        try {
            $slmuon = Sach::where('masach','=',$id)->first()['damuon'] + $sl;
            // dd($slmuon);
            $result = Sach::where('masach','=',$id)
            ->update([
                'damuon' => $slmuon,
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

    public function updateLoseBook($id, $sl) {
        try {
            $slmuon = Sach::where('masach','=',$id)->first()['damat'] + $sl;
            // dd($slmuon);
            $result = Sach::where('masach','=',$id)
            ->update([
                'damat' => $slmuon,
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
            $result = Sach::where('masach', '=', $id)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function deleteMulti($ids) {
        try {
            $result = Sach::whereIn('masach', $ids)->delete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getOneNew(){
        $data = Sach::select('*')
        ->orderBy('masach', 'DESC')
        ->limit(1)
        ->get();
        return $data;
    }

    public function getEightNew(){
        $data = Sach::select('*')
        ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
        ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
        ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
        ->join('loais', 'saches.maloai', '=', 'loais.maloai')
        ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
        ->orderBy('saches.masach', 'DESC')
        ->where('chitietsaches.display', 1)
        ->limit(8)
        ->get();
        return $data;
    }

    public function getGoodBook(){
        $data = Sach::select('*')
        ->select(DB::raw('count(*) as count'), 'saches.masach')
        ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
        ->join('muontras', 'saches.masach', '=', 'muontras.masach')
        ->groupBy('saches.masach')
        ->orderBy('count', 'DESC')
        ->where('chitietsaches.display', 1)
        ->limit(4)
        ->get();
        return $data;
    }

    // public function getListGoodBook(){
    //     $data = Sach::select('*')
    //     ->select(DB::raw('count(*) as count'), 'saches.masach')
    //     ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
    //     ->join('muontras', 'saches.masach', '=', 'muontras.masach')
    //     ->groupBy('saches.masach')
    //     ->orderBy('count', 'DESC')
    //     ->where('chitietsaches.display', 1)
    //     ->paginate(4);
    //     return $data;
    // }

    public function getRecommendedBook(){
        $data = Sach::select('*')
        ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
        ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
        ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
        ->join('loais', 'saches.maloai', '=', 'loais.maloai')
        ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
        ->where('chitietsaches.display', 1)
        ->orderBy('chitietsaches.index', 'desc')
        ->limit(4)
        ->get();
        return $data;
    }

    public function getListRecommendedBook(){
        $data = Sach::select('*')
        ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
        ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
        ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
        ->join('loais', 'saches.maloai', '=', 'loais.maloai')
        ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
        ->where('chitietsaches.display', 1)
        ->orderBy('chitietsaches.index', 'desc')
        ->paginate(8);
        return $data;
    }

    public function getNew()
    {
        try {
            $data = Sach::select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->join('loais', 'saches.maloai', '=', 'loais.maloai')
            ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search($col_name, $key, $limit, $order, $by)
    {
        try {
            $data = Sach::select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->join('loais', 'saches.maloai', '=', 'loais.maloai')
            ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
            ->where('chitietsaches.'.$col_name, 'like', "%$key%")
            ->where('chitietsaches.display', 1)
            ->orderBy($order, $by)
            // ->orderBy($orderby)
            ->paginate($limit);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function searchWithType($col_name, $key, $type, $idtype, $limit, $order, $by)
    {
        try {
            $data = Sach::select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->join('loais', 'saches.maloai', '=', 'loais.maloai')
            ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
            ->where('chitietsaches.'.$col_name, 'like', "%$key%")
            ->where($type, $idtype)
            ->where('chitietsaches.display', 1)
            ->orderBy($order, $by)
            ->paginate($limit);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearch($col_name, $key)
    {
        try {
            $data = Sach::select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->join('loais', 'saches.maloai', '=', 'loais.maloai')
            ->join('trangthais', 'saches.tinhtrang', '=', 'trangthais.id')
            ->where('chitietsaches.'.$col_name, 'like', "%$key%")
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearchWithMajors($id, $key)
    {
        try {
            $data = Sach::select('*')->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->where('chitietsaches.ten', 'like', "%$key%")
            ->where('nganhs.manganh', "$id")
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearchWithCategory($id, $key)
    {
        try {
            $data = Sach::select('*')->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('loais', 'loais.maloai', '=', 'saches.maloai')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->where('chitietsaches.ten', 'like', "%$key%")
            ->where('loais.maloai', "$id")
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByMajors($nganh)
    {
        try {
            $data = Sach::select('*')->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->where('nganhs.manganh', $nganh)
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getByCategory($loai)
    {
        try {
            $data = Sach::select('*')->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('loais', 'loais.maloai', '=', 'saches.maloai')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->where('loais.maloai', $loai)
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSearchDelete($col_name, $key)
    {
        try {
            $data = Sach::onlyTrashed()->select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('sach_nganhs', 'sach_nganhs.masach', '=', 'saches.masach')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->where('chitietsaches.'.$col_name, 'like', "%$key%")
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id){
        try {
            $data = Sach::select('*')->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            ->join('nganhs', 'nganhs.manganh', '=', 'saches.manganh')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->join('loais', 'loais.maloai', '=', 'saches.maloai')
            ->join('trangthais', 'trangthais.id', '=', 'saches.tinhtrang')
            ->where('saches.masach', '=', $id)
            ->first();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDelete()
    {
        try {
            $data = Sach::onlyTrashed()->select('*')
            ->join('chitietsaches', 'saches.masach', '=', 'chitietsaches.masach')
            // ->join('sach_nganhs', 'sach_nganhs.masach', '=', 'saches.masach')
            ->join('vitris', 'saches.mavt', '=', 'vitris.mavt')
            ->orderBy('saches.masach', 'DESC')
            ->paginate(4);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function restore($id)
    {
        try {
            $result = Sach::withTrashed()
            ->where('masach', '=', $id)->restore();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function restore_multi($ids)
    {
        try {
            $result = Sach::withTrashed()
            ->whereIn('masach',$ids)->restore();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy($id)
    {
        try {
            $result = Sach::withTrashed()
            ->where('masach', '=', $id)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy_multi($ids)
    {
        try {
            $result = Sach::withTrashed()
            ->whereIn('masach', $ids)->forceDelete();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function check($id)
    {
        try {
            $result = Sach::where('masach', $id)->first();
            return $result ? true : false;
        } catch (\Exception $e) {
            return $e;
        }
    }

}
