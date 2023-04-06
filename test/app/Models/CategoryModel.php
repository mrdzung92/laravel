<?php

namespace App\Models;

use App\Models\AdminModel;
use Config;
use DB;

class CategoryModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'category';
        $this->controllerName = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted = [];
        $this->arrayCrudNotAccepted = ['_token'];

    }

    public function listItems($params = null, $option = null)
    {
        $this->fieldSearchAccepted = Config::get('myConfig.config.search.' . $this->controllerName);
        if (($key = array_search('all', $this->fieldSearchAccepted)) !== false) {
            unset($this->fieldSearchAccepted[$key]);
        }

        $result = null;
        if ($option['task'] === 'admin-list-item') {
            $query = $this->select('id', 'name','is_home', 'display' ,'created', 'created_by', 'modified', 'modified_by', 'status');

            if ($params['filter']['status'] !== 'all') {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] === 'all') {

                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {

                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } elseif (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemPerPage']);
        }

        if ($option['task'] === 'news-list-items') {

            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')
                ->limit(8);

            $result = $query->get()->toArray();

        }
        if ($option['task'] === 'news-list-items-is-home') {
           
            $query = $this->select('id', 'name','display')
                ->where('status', '=', 'active')
                ->where('is_home', '=', 'yes')
                ->limit(8);

            $result = $query->get()->toArray();
        }

        if ($option['task'] === 'admin-list-items-in-selectbox') {
           
            $query = $this->select('id', 'name')
                ->where('status', '=', 'active')
                ->orderBy('name','asc');
                
            $result = $query->pluck('name','id')->toArray();
        }

        if ($option['task'] === 'news-get-item') { 
         
            $result = $this->select('id', 'name','display')
                ->where('id', '=',$params['id'])
                ->first();
                if($result) $result =$result->toArray();
                      
        }


        return $result;
    }

    public function countItems($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] === 'admin-count-item-group-by-status') {

            $query = $this::select(DB::raw('COUNT(id) as count,status'))
                ->groupBy('status');
            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] === 'all') {

                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {

                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } elseif (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }
            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $option = null)
    {
        if ($option['task'] === 'changeStatus') {
            $status = ($params['currentStatus'] === 'active') ? 'inactive' : 'active';
            $this::where('id', $params['id'])
                ->update(['status' => $status]);
        }

        if ($option['task'] === 'add-item') {
            $params['created'] = date('Y-m-d h:m:s', time());
            $params['created_by'] = 'admin';
          
            self::insert($this->repairParams($params));
        }
        if ($option['task'] === 'edit-item') {
            $params['modified'] = date('Y-m-d h:m:s', time());
            $params['modified_by'] = 'admin';
            self::where('id', $params['id'])->update($this->repairParams($params));

        }

        if ($option['task'] === 'change-is-home') {
            $status = ($params['currentIsHome'] === 'yes') ? 'no' : 'yes';
            $this::where('id', $params['id'])
                ->update(['is_home' => $status]);

        }

        if ($option['task'] === 'change-display') {
            $this::where('id', $params['id'])
                ->update(['display' => $params['currentDisplay']]);

        }
    }

    public function deleteItem($params = null, $option = null)
    {
        if ($option['task'] === 'delete-item') {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            self::where('id', $params['id'])
                ->delete();
        }
    }

    public function getItem($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] === 'get-item') {
            $result = $this->select('id', 'name', 'status')
                ->where('id', $params['id'])->first();
        }
       
        return $result;
    }

}
