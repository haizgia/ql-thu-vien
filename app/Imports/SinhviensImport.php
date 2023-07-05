<?php

namespace App\Imports;

use App\Models\Sinhvien;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
use Carbon\Carbon;
use App\Rules\phone;

class SinhviensImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow() : int
    {
        return 1;
    }

    public function model(array $row)
    {
        // dd($row);
        // $ngaynh = explode('-', $row['ngay_nhap_hoc']);
        // $ngaynh[0] += 2;
        $ngaynh = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_nhap_hoc'])->format('Y-m-d');
        $ngayhh = Carbon::create($ngaynh)->addYears(2)->format('Y-m-d');
        $ngaysinh = implode('-',array_reverse(explode('/', $row['ngay_sinh'])));
        $pass = implode(explode('/', $row['ngay_sinh']));
        // dd($row, $ngayhh, $ngaysinh);
        // ->syncRoles('user');
        return [
            new Sinhvien([
                //
                'mssv' => $row['mssv'],
                'hoten' => $row['ho_dem'].' '.$row['ten'],
                'malop' => $row['ma_lop'],
                'ngaysinh' => $ngaysinh,
                'gioitinh'=> $row['gioi_tinh'],
                'sdt' => $row['sdt'],
                'diachi' => $row['dia_chi'],
                'trangthai' => 0,
                'ngayhethan' => $ngayhh,
            ]),
            new User([
                'id' => $row['mssv'],
                'name' => $row['ho_dem'].' '.$row['ten'],
                'password' => Hash::make("$pass"),
            ]),
        ];

    }

    public function rules(): array
    {
        return [
            '*.mssv' => 'required|max:10000000|unique:sinhviens',
            '*.ho_dem' => 'required',
            '*.ten' => 'required',
            '*.ma_lop' => 'required',
            '*.ngay_sinh' => 'required',
            '*.gioi_tinh' => 'required',
            '*.sdt' => ['required','max:13', new phone()],
            '*.dia_chi' => 'required',
            '*.ngay_nhap_hoc' => [
                'required',
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.mssv.required' => ':attribute không được để trống',
            '*.ho_dem.required' => ':attribute không được để trống',
            '*.ten.required' => ':attribute không được để trống',
            '*.ma_lop.required' => ':attribute không được để trống',
            '*.ngay_sinh.required' => ':attribute không được để trống',
            '*.gioi_tinh.required' => ':attribute không được để trống',
            '*.sdt.required' => ':attribute không được để trống',
            '*.dia_chi.required' => ':attribute không được để trống',
            '*.ngay_nhap_hoc.required' => ':attribute không được để trống',
            '*.mssv.unique' => ':attribute đã tồn tại',
            '*.mssv.max' => ':attribute không hợp lệ',
            '*.sdt.max' => ':attribute không hợp lệ',
        ];
    }
}
