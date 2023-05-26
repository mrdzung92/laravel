<?php

namespace App\Models;

use App\Models\AdminModel;
use Config;
use DB;

class MenuModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'menu';
        $this->controllerName = 'menu';
        $this->folderUpload = 'menu';
        $this->fieldSearchAccepted = [];
        $this->arrayCrudNotAccepted = ['_token', 'thumb_current'];

    }

    public function listItems($params = null, $option = null)
    {
        $this->fieldSearchAccepted = Config::get('myConfig.config.search.' . $this->controllerName);
        if (($key = array_search('all', $this->fieldSearchAccepted)) !== false) {
            unset($this->fieldSearchAccepted[$key]);
        }

        $result = null;
        if ($option['task'] === 'admin-list-item') {
            $query = $this->select('id', 'name', 'ordering', 'link','type_menu', 'type_open', 'created', 'created_by', 'modified', 'modified_by', 'status');

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

            $result = $query->orderBy('ordering', 'asc')
                ->paginate($params['pagination']['totalItemPerPage']);
        }

        if ($option['task'] === 'news-list-items') {

            $query = $this->select('id', 'name', 'link', 'type_menu', 'type_open')
                ->where('status', '=', 'active')
                ->orderBy('ordering', 'asc');
            $result = $query->get()->toArray();

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

        if ($option['task'] === 'change-type-open') {
            $this::where('id', $params['id'])
                ->update(['type_open' => $params['currentValue']]);
        }

        if ($option['task'] === 'change-type-menu') {
            $this::where('id', $params['id'])
                ->update(['type_menu' => $params['currentValue']]);
        }

        if ($option['task'] === 'change-ordering') {
            $this::where('id', $params['id'])
                ->update(['ordering' => $params['currentValue']]);

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
    }

    public function deleteItem($params = null, $option = null)
    {
        if ($option['task'] === 'delete-item') {
            self::where('id', $params['id'])
                ->delete();
        }
    }

    public function getItem($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] === 'get-item') {
            $result = $this->select('id', 'name', 'ordering', 'link','type_menu', 'type_open',  'status')
                ->where('id', $params['id'])->first();
        }
        if ($option['task'] === 'get-thumb') {
            $result = $this->select('thumb', 'id')
                ->where('id', $params['id'])->first();
        }
        return $result;
    }

}
