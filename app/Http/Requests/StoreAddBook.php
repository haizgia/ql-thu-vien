<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddBook extends FormRequest
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
            'index' => 'required|numeric',
            'tacgia' => 'required',
            'nxb' => 'required',
            'ten' => 'required',
            'mota' => 'required',
            'soluong' => 'required|numeric',
            'hinhanh' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'manganh' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'index.required' => 'Trường này bắt buộc phải nhập',
            'tacgia.required' => 'Trường này bắt buộc phải nhập',
            'nxb.required' => 'Trường này bắt buộc phải nhập',
            'ten.required' => 'Trường này bắt buộc phải nhập',
            'mota.required' => 'Trường này bắt buộc phải nhập',
            'soluong.required' => 'Trường này bắt buộc phải nhập',
            'hinhanh.mimes' => 'Chỉ chấp nhận hình ảnh với đuôi .jpg .jpeg .png .gif',
			'hinhanh.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
            'manganh.required' => 'Bạn phải chọn ít nhất một ngành'
        ];
    }
}
