<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class AdminModel extends Model
{
    // chọn bảng thao tác là slider
    protected $table = '';
    protected $folderUpload = '';

    // chọn khóa chính là cột id
    // protected $primaryKey = 'id';

    // tùy chỉnh kiểu dữ liệu của khóa chính 
    // protected $keyType = 'string';

    public $timestamps = false; // cài đặt tự động cập nhật thời gian chỉnh sửa , thời gian tạo dữ liệu 

    // tùy chỉnh thời gian tạo và cập nhật dữ liệu 
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccept = [
        'id',  'name'
    ];
    // những field không được thêm vào database
    protected $crudNotAccept = [
        '_token',  'thumb_current'
    ];
   


   


   
  
    public function getDbCol($data)
    {
        $result = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $arrColumn = array_flip(array_values($result));
        $data = array_intersect_key($data, $arrColumn);
        return  $data;
    }

    public function deleteThumb($thumbName)
    {
        Storage::disk('my_strorage_image')->delete("$this->folderUpload/" . $thumbName);
    }

    public function saveThumb($thumbObj)
    {
        $thumbName = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'my_strorage_image');
        return $thumbName;
    }

    public function repairParams($params)
    {
        return array_diff_key($params, array_flip($this->crudNotAccept));
    }
}
