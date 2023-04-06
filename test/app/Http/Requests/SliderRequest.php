<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest

{
    private $table = 'slider'; // định nghĩa table
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
        $id =$this->id;
        $condThumb = 'bail|required|image|max:100';
        $condName = "required|between:5,100|unique:$this->table,name";
        if(!empty($id)){
            $condThumb = 'bail|mimes:jpeg,jpg,bmp,png,gif|max:1000';
            $condName = "required|between:5,100|unique:$this->table,name,$id";
        }
       
        return [
            'name'=>$condName,
            'description'=>'required',
            'link'=>'bail|required|url',
            'status'=>'bail|in:active,inactive',
            'thumb'=>$condThumb
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '<strong>- Name :</strong> không được rỗng',
            'name.min'      =>'<strong>- Name :</strong> chiều dài ít nhất phải :min ký tự',
            'description.required' => '<strong>- Description :</strong> không được rỗng',
            'link.required' => '<strong>- Link :</strong> không được rỗng',
            'link.url' => '<strong>- Link :</strong> không đúng định dạng url',
            'status.in' => '<strong>- Status :</strong> phải là giá trị khác giá trị mặc định',
            'thumb.required' => '<strong>- Thumb :</strong> không được rỗng',
            'thumb.mimes' => '<strong>- Thumb :</strong> Phải là ảnh',
            // 'thumb.image' => '<strong>- Thumb :</strong> Phải là ảnh',
        ];
    }

}
