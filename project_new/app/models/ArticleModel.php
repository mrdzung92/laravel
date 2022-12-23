<?php

namespace App\models;
use App\models\AdminModel;
use DB;

class ArticleModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'article';
        $this->folderUpload = 'article';
        $this->fieldSearchAccept = ['id',  'name', 'content'];
        // những field không được thêm vào database
        $this->crudNotAccept = ['_token',  'thumb_current'];
    }
    public function listItem($params, $option)
    {

        $result = null;
        if ($option['task'] == 'admin-list-item') {
            // $result = SliderModel::all('id','name','link');
            $query = $this->select('id', 'name', 'content', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

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
           $query = $this->select('id','name','content','thumb')
           ->where('status','=','active')->limit(5);
           $result =$query->get()->toArray();
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

        if ($option['task'] == 'add-item') {
            $params['created'] = date('Y-m-d H:i:s', time());
            $params['created_by'] = 'admin';
            $params['thumb'] = $this->saveThumb($params['thumb']);

            self::insert($this->repairParams($params));
        }

        if ($option['task'] == 'edit-item') {

            $params['modified'] = date('Y-m-d H:i:s', time());
            $params['modified_by'] = 'admin';
            if (!empty($params['thumb'])) {
                $currentThumb = $params['thumb_current'];
                $params['thumb'] = $this->saveThumb($params['thumb']);
                $this->deleteThumb($currentThumb);
            }
            self::where('id', $params['id'])->update($this->repairParams($params));
        }
    }


    public function deleteItem($params = null, $option = null)
    {
        if ($option['task'] == 'delete-item') {
            $item = self::getItems($params, ['task' => 'get-thumb']);

            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])
                ->delete();
        }
    }

    public function getItems($params = null, $option = null)
    {
        $result = null;
        if ($option['task'] == 'get-item') {
            $result = self::select('id', 'name', 'content', 'thumb', 'status','category_id')
                ->where('id', $params['id'])->first()->toArray();
        }
        if ($option['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first()->toArray();
        }
        return $result;
    }
}
