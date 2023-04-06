<?php

namespace App\Models;

use App\Models\AdminModel;
use Config;
use DB;

class SliderModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'slider';
        $this->controllerName = 'slider';
        $this->folderUpload = 'slider';
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
            $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

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

            $query = $this->select('id', 'name', 'description', 'thumb','link')
                ->where('status', '=', 'active')
                ->limit(5);

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

        if ($option['task'] === 'add-item') {
            $params['created'] = date('Y-m-d h:m:s', time());
            $params['created_by'] = 'admin';
            $params['thumb'] = $this->uploadThumb($params['thumb']);
            self::insert($this->repairParams($params));
        }
        if ($option['task'] === 'edit-item') {
            if (!empty($params['thumb'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }
            $params['modified'] = date('Y-m-d h:m:s', time());
            $params['modified_by'] = 'admin';
            self::where('id', $params['id'])->update($this->repairParams($params));

        }
    }

    public function deleteItem($params = null, $option = null)
    {
        if ($option['task'] === 'delete-item') {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);

            self::where('id', $params['id'])
                ->delete();
        }
    }

    public function getItem($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] === 'get-item') {
            $result = $this->select('id', 'name', 'description', 'link', 'thumb', 'status')
                ->where('id', $params['id'])->first();
        }
        if ($option['task'] === 'get-thumb') {
            $result = $this->select('thumb', 'id')
                ->where('id', $params['id'])->first();
        }
        return $result;
    }

}
