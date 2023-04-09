<?php

namespace App\Models;

use Config;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminModel extends Model
{
    
    
    // protected $primaryKey = 'flight_id'; định nghĩa khoá chính , mặc định là id
    // public $incrementing = false; khoá chính mặc định là tự tăng , nếu đặt là false thì sẽ không tự tăng
   
    public $timestamps = false; //mặc định tự động cập nhật thời gian thêm mới  và chỉnh sửa, nếu set là false thì không cập nhật

    const CREATED_AT = 'created'; //cập nhật lại tên cột thời gian tạo dữ liệu trong db
    const UPDATED_AT = 'modified'; //cập nhật lại tên cột thời gian chỉnh sửa dữ liệu trong db
    protected $table = ''; // định nghĩa table
    protected $folderUpload = '';
    protected $controllerName = '';
    protected $fieldSearchAccepted = [];
    protected $arrayCrudNotAccepted = [
        '_token', 'thumb_current',
    ]; //những cột không được phép thêm vào trong database


    public function uploadThumb($thumbObj)
    {

        $thumName = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumName, 'my_storage_image');
        return $thumName;
    }

    public function deleteThumb($thumName)
    {
        Storage::disk('my_storage_image')->delete($this->folderUpload . '/' . $thumName);
    }

    public function repairParams($params)
    {
       return array_diff_key($params, array_flip($this->arrayCrudNotAccepted));
    }

   
}
