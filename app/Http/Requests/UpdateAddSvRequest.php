<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\phone;
class UpdateAddSvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ten' => 'required',
            'ngaysinh' => 'required|before:today',
            'sdt'=>['max:12', new phone()],
            'ngaynhaphoc' => 'required|before:today',
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Trường :attribute bắt buộc phải nhập',
            'ngaysinh.required' => 'Trường :attribute bắt buộc phải nhập',
            'ngaysinh.before' => 'Ngày sinh không hợp lệ',
            'ngaynhaphoc.required' => 'Trường :attribute bắt buộc phải nhập',
            'sdt.max' => 'Số điện thoại khôn hợp lệ',
            'ngaynhaphoc.before' => 'Ngày nhập học không hợp lệ',
        ];
    }
}
