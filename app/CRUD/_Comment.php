<?php

namespace App\CRUD;

use App\Models\Comment;

class _Comment {
    public function create($data) {
        try {
            $result = Comment::create($data);
            if ($result->id > 0) {
                return true;
            }
        } catch (\Exception $e) {
            return $e;
        }
        return false;
    }

    public function getByIdUser($id, $ms)
    {
        try {
            $data = Comment::where('masach', $ms)
            ->where('id_user', $id)
            ->orderBy('created_at', 'desc')
            ->get();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($id)
    {
        try {
            $data = Comment::where('id', $id)->delete();
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($id, $nd)
    {
        try {
            $data = Comment::where('id', $id)
            ->update($nd);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getById($id)
    {
        try {
            $data = Comment::select('comments.*', 'sinhviens.hoten')
            ->join('sinhviens', 'comments.id_user', '=', 'sinhviens.mssv')
            ->where('masach', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(1);
            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
