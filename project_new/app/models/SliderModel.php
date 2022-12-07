<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function listItem($params, $option)
    {

        $result = null;
        if ($option['task'] == 'admin-list-item') {

            // $result = SliderModel::all('id','name','link');
            $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

            if ($params['filter']['status'] !== 'all') {
                $query->where('status', $params['filter']['status']);
            }
            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }


    public function countItems($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'admin-count-item-group-by-status') {
            $result = self::select(DB::raw('count(id) as count,status'))
                ->groupBy('status')
                ->get()
                ->toArray();
        }
        return $result;
    }
}
