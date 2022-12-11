<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    private $table ='slider';
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
        $id = $this->id;
        $thumCondition = "bail|required|mimes:jpeg,png,jpg,gif,svg|max:100000";
        $nameCondition = "required|between:5,100|unique:$this->table,name";
        if(!empty($id)){
            $nameCondition .= ",$id"; 
            $thumCondition = "bail|mimes:jpeg,png,jpg,gif,svg|max:100000";
        } 
        return [
            'name' => $nameCondition,
            'description' => 'required',
            'link' => 'bail|required|min:5|url',
            'status' => 'bail|in:active,inactive',  
            'thumb'  =>     $thumCondition  
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'Tên không được rỗng',
            'name.min'    => ':input chiều dài phải có ít nhất :min ký tự',
            'description.required'    => 'description :đây là trường bắt buộc',
            'link.required' => 'link : đây là trường bắt buộc',
            'link.url'  =>'link : Định dạng không hợp lệ',
            'status.in'  =>'status : Giá trị không hợp lệ',

            // 'in'      => 'The :attribute must be one of the following types: :values',
        ];
    }

    public function attributes()
    {
        
        return [
            'name'    => 'Tên',
            'description'    => 'Mô tả',
            // 'size'    => 'The :attribute must be exactly :size.',
            // 'between' => 'The :attribute value :input is not between :min - :max.',
            // 'in'      => 'The :attribute must be one of the following types: :values',
        ];
    }
}
