<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest

{
    private $table = 'category'; // định nghĩa table
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
        $condName = "required|between:4,100|unique:$this->table,name";
        if(!empty($id)){       
            $condName = "required|between:4,100|unique:$this->table,name,$id";
        }
       
        return [
            'name'=>$condName,
            'status'=>'bail|in:active,inactive',
            'is_home'=>'bail|in:yes,no',
            'display'=>'bail|in:grid,list',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '<strong>- Name :</strong> không được rỗng',
            'name.min'      =>'<strong>- Name :</strong> chiều dài ít nhất phải :min ký tự',     
            'status.in' => '<strong>- Status :</strong> phải là giá trị khác giá trị mặc định',
            'is_home.in' => '<strong>- Show is Home :</strong> phải là giá trị khác giá trị mặc định',
            'display.in' => '<strong>- Display :</strong> phải là giá trị khác giá trị mặc định',
        ];
    }

}
