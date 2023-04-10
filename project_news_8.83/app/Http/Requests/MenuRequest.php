<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Config;
class MenuRequest extends FormRequest

{
    private $table = 'menu'; // định nghĩa table
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
        $condTypeOpen = implode(',',array_keys(Config::get('myConfig.template.type_open')));
        $condTypeMenu = implode(',',array_keys(Config::get('myConfig.template.type_menu')));

        $condName = "required|between:5,100|unique:$this->table,name";
        if(!empty($id)){
            $condName = "required|between:5,100|unique:$this->table,name,$id";
        }
     
        return [
            'name'=>$condName,
            'link'=>'bail|required|',
            'ordering'=>'bail|numeric',
            'status'=>'bail|in:active,inactive',
            'type_open'=>"bail|in:$condTypeOpen",
            'type_menu'=>"bail|in:$condTypeMenu",
            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '<strong>- Name :</strong> không được rỗng',
            'name.min'      =>'<strong>- Name :</strong> chiều dài ít nhất phải :min ký tự',
            'link.required' => '<strong>- Link :</strong> không được rỗng',
            'link.url' => '<strong>- Link :</strong> không đúng định dạng url',
            'status.in' => '<strong>- Status :</strong> phải là giá trị khác giá trị mặc định',
            'type_open.in' => '<strong>- Type Open :</strong> phải là giá trị khác giá trị mặc định',
            'type_menu.in' => '<strong>- Type Menu :</strong> phải là giá trị khác giá trị mặc định',
        ];
    }

}
