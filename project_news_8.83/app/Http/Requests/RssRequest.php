<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Config;
class RssRequest extends FormRequest

{
    private $table = 'rss'; // định nghĩa table
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
       
        $condName = "required|between:5,100|";
        $condSource = implode(',',array_keys(Config::get('myConfig.template.source')));
        if(!empty($id)){
            $condName = "required|between:5,100|unique:$this->table,name,$id";
        }
       
        return [
            'name'=>$condName,
            'ordering'=>'required',
            'link'=>'bail|required|url',
            'status'=>'bail|in:active,inactive',
            'source'=>"bail|in:$condSource",
          
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '<strong>- Name :</strong> không được rỗng',
            'name.min'      =>'<strong>- Name :</strong> chiều dài ít nhất phải :min ký tự', 
            'link.required' => '<strong>- Link :</strong> không được rỗng',
            'link.url' => '<strong>- Link :</strong> không đúng định dạng url',
            'ordering.required' => '<strong>- Ordering :</strong> không được rỗng',
            'status.in' => '<strong>- Status :</strong> phải là giá trị khác giá trị mặc định',
          
        ];
    }

}
