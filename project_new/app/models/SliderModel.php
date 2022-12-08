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
    protected $fieldSearchAccept = [
        'id',  'name', 'description', 'link'
    ];
    public function listItem($params, $option)
    {

        $result = null;
        if ($option['task'] == 'admin-list-item') {
            // $result = SliderModel::all('id','name','link');
            $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

            if ($params['filter']['status'] !== 'all') {
                $query->where('status', $params['filter']['status']);
            }

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccept as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccept)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
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

            $query = $this::groupBy('status')
                ->select(DB::raw('count(id) as count,status'));
            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccept as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccept)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }
            $result = $query->get()->toArray();
        }
        return $result;
    }


    public function saveItem($params = null, $option = null)
    {
        
        if ($option['task'] == 'change-status') {
            $status = ($params['currentStatus']=='active')?'inactive':'active';
            self::where('id', $params['id'])
            ->update(['status' => $status]);
          
        }
        
    }


    public function deleteItem($params = null, $option = null)
    {       
        if ($option['task'] == 'delete-item') {
           self::where('id', $params['id'])
            ->delete();         
        }
        
    }
}
