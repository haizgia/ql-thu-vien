<?php

namespace App\Imports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;

use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, SkipsEmptyRows, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function headingRow() : int
    {
        return 1;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $ngaysinh = implode(explode('/', $row['ngay_sinh']));
        // dd($ngaysinh);
        return new User([
            //
            'id' => $row['mssv'],
            'name' => $row['ho_dem'].' '.$row['ten'],
            'password' => Hash::make("$ngaysinh"),
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         '*.mssv' => 'required|max:10000000|unique:users',
    //         '*.ho_dem' => 'required',
    //         '*.ten' => 'required',
    //     ];
    // }
}
