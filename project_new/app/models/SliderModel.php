<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class SliderModel extends Model
{
    // chọn bảng thao tác là slider
    protected $table = 'slider';
    protected $folderUpload = 'slider';

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
    // những field không được thêm vào database
    protected $crudNotAccept = [
        '_token',  'thumb_current'
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

        if ($option['task'] == 'add-item') {
            $params['created'] = date('Y-m-d H:i:s',time());
            $params['created_by'] = 'admin';
            $thumb = $params['thumb'];
            $params['thumb'] = Str::random(10).'.'.$thumb->clientExtension();
            $thumb -> storeAs($this->folderUpload,$params['thumb'],'my_strorage_image');
            $params = array_diff_key($params,array_flip($this->crudNotAccept));
            self::insert($params);
        }

        if ($option['task'] == 'edit-item') {
            
          
        }
        
    }


    public function deleteItem($params = null, $option = null)
    {       
        if ($option['task'] == 'delete-item') {
            $item = self::getItems($params,['task'=>'get-thumb']);
            Storage::disk('my_strorage_image')->delete("$this->folderUpload/".$item['thumb']);
            self::where('id', $params['id'])
            ->delete();         
        }
        
    }

    public function getItems($params = null, $option = null)
    {       
        $result =null;
        if ($option['task'] == 'get-item') {
            $result = self::select('id', 'name', 'description', 'link', 'thumb','status')
            ->where('id',$params['id'])->first()->toArray();         
        }
        if ($option['task'] == 'get-thumb') {
            $result = self::select('id','thumb')->where('id',$params['id'])->first()->toArray();  
                   
        }
        return $result;
    }

    public function getDbCol($data)
    {   
       $result = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable()) ;
        $arrColumn = array_flip(array_values($result));
        $data = array_intersect_key($data, $arrColumn);
        return  $data;
    }
}
