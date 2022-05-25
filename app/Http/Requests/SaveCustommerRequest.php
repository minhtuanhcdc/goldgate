<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCustommerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','string'],
            'birthday'=>['required','integer'],
            'genger'=>['nullable','integer'],
            'address'=>['required','string'],
            'status'=>['nullable','integer'],
            'ousent_id'=>['nullable','integer'],
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Nhập tên bệnh nhân',
            'address.required'=>'Nhập address',
            'birthday.required'=>'Nhập năm sinh',
            'ousent_id.required'=>'Chọn đơn vị gửi mẫu',
        ];
    }
}
