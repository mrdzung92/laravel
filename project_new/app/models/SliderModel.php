<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    // chọn bảng thao tác là slider
    protected $table = 'slider';
    
    // chọn khóa chính là cột id
    // protected $primaryKey = 'id';

    // tùy chỉnh kiểu dữ liệu của khóa chính 
    // protected $keyType = 'string';

    public $timestamps = false; // cài đặt tự động cập nhật thời gian chỉnh sửa , thời gian tạo dữ liệu 

    // tùy chỉnh thời gian tạo và cập nhật dữ liệu 
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function listItem($params,$option){
        $result =null;
        if($option['task']=='admin-list-item'){
            // $result = SliderModel::all('id','name','link');
            $result = self::select('id','name','description','link','thumb','created','created_by','modified','modified_by','status')
            // ->where('id','>',3)
            ->get();
        }
       return $result;
    }
   
}
