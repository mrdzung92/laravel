<?php

namespace App\models;

use App\models\AdminModel;
use DB;

class CategoryModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccept = ['id',  'name'];
        // những field không được thêm vào database
        $this->crudNotAccept = ['_token'];
    }
    public function listItem($params, $option)
    {

        $result = null;
        if ($option['task'] == 'admin-list-item') {
            // $result = SliderModel::all('id','name','link');
            $query = $this->select('id', 'name', 'is_home', 'display', 'created', 'created_by', 'modified', 'modified_by', 'status');

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

        if ($option['task'] == 'news-list-items') {
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')->limit(8);
            $result = $query->get()->toArray();
        }

        if ($option['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name', 'display')
                ->where('status', '=', 'active')
                ->where('is_home', '=', '1');
            $result = $query->get()->toArray();
        }

        if ($option['task'] == 'admin-list-items-in-selectBox') {
            $query = $this->select('id', 'name')
                ->orderBy('name','asc')
                ->where('status','=','active');
            $result = $query->pluck('name','id')->toArray();
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
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])
                ->update(['status' => $status]);
        }

        if ($option['task'] == 'change-is-home') {
            $isHome = ($params['currentIsHome'] == '1') ? '0' : '1';
            self::where('id', $params['id'])
                ->update(['is_home' => $isHome]);
        }

        if ($option['task'] == 'add-item') {
            $params['created'] = date('Y-m-d H:i:s', time());
            $params['created_by'] = 'admin';


            self::insert($this->repairParams($params));
        }

        if ($option['task'] == 'edit-item') {

            $params['modified'] = date('Y-m-d H:i:s', time());
            $params['modified_by'] = 'admin';
            self::where('id', $params['id'])->update($this->repairParams($params));
        }

        if ($option['task'] == 'change-display') {
            $data = [];
            $data['modified'] = date('Y-m-d H:i:s', time());
            $data['modified_by'] = 'admin';
            $data['display'] = $params['currentDisplay'];
            self::where('id', $params['id'])->update($data);
        }
    }


    public function deleteItem($params = null, $option = null)
    {
        if ($option['task'] == 'delete-item') {
            $item = self::getItems($params, ['task' => 'get-thumb']);
            self::where('id', $params['id'])
                ->delete();
        }
    }

    public function getItems($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'get-item') {
            $result = self::select('id', 'name',  'status')
                ->where('id', $params['id'])->first()->toArray();
        }
        return $result;
    }
}
