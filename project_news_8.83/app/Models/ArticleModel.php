<?php

namespace App\Models;

use App\Models\AdminModel;
use Config;
use DB;

class ArticleModel extends AdminModel
{

    public function __construct()
    {
        $this->table = 'article';
        $this->controllerName = 'article';
        $this->folderUpload = 'article';
        $this->fieldSearchAccepted = [];
        $this->arrayCrudNotAccepted = ['_token', 'thumb_current'];

    }

    public function listItems($params = null, $option = null)
    {
        $this->table = 'article as a';
        $this->fieldSearchAccepted = Config::get('myConfig.config.search.' . $this->controllerName);

        if (($key = array_search('all', $this->fieldSearchAccepted)) !== false) {
            unset($this->fieldSearchAccepted[$key]);
        }

        $result = null;
        if ($option['task'] === 'admin-list-item') {
            $query = $this->select('a.id', 'a.name', 'a.category_id', 'a.content', 'a.thumb', 'a.created', 'a.created_by', 'a.modified', 'a.modified_by', 'a.status', 'a.type', 'c.name as category_name')
                ->join('category as c', 'a.category_id', '=', 'c.id');

            if ($params['filter']['status'] !== 'all') {
                $query->where('a.status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] === 'all') {

                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {

                            $query->orWhere('a.' . $column, 'LIKE', "%{$params['search']['value']}%");
                        }
                    });
                } elseif (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where('a.' . $params['search']['field'], 'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemPerPage']);
        }

        if ($option['task'] === 'news-list-items') {

            $query = $this->select('id', 'name', 'description', 'thumb', 'link')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get()->toArray();

        }

        if ($option['task'] === 'news-list-items-featured') {

            $query = $this->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'a.thumb', 'c.name as category_name')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', '=', 'featured')
                ->orderBy('a.id', 'desc')
                ->take(3);

            $result = $query->get()->toArray();

        }

        if ($option['task'] === 'news-list-items-latest') {

            $query = $this->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'a.thumb', 'c.name as category_name')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('a.id', 'desc')
                ->take(4);

            $result = $query->get()->toArray();

        }

        if ($option['task'] === 'news-list-items-in-category') {
            $query = $this->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'a.thumb')
                ->where('a.status', '=', 'active')
                ->where('a.category_id', '=', $params['category_id'])
                ->orderBy('a.id', 'desc')
                ->take(4);

            $result = $query->get()->toArray();

        }
        $this->table = 'article';

        
        if ($option['task'] === 'news-list-items-realated-in-category') {
            $query = $this->select('id', 'name', 'content', 'created' , 'thumb')
                ->where('status', '=', 'active')
                ->where('category_id', '=', $params['category_id'])
                ->where('id', '!=', $params['article_id'])
                ->orderBy('id', 'desc')
                ->take(4);

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
            // $this->table = 'article';
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

        if ($option['task'] === 'change-type') {
            $this::where('id', $params['id'])
                ->update(['type' => $params['currentType']]);

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
            $result = $this->select('id', 'name', 'content', 'category_id', 'thumb', 'status')
                ->where('id', $params['id'])->first();
        }
        if ($option['task'] === 'get-thumb') {
            $result = $this->select('thumb', 'id')
                ->where('id', $params['id'])->first();
        }

        if ($option['task'] === 'news-get-item') {

            $result = DB::table($this->table . ' as a')->select('a.id', 'a.name', 'a.content', 'a.category_id', 'a.thumb', 'c.name as category_name', 'a.created','c.display')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.id', $params['article_id'])
                ->where('a.status', '=', 'active')
                ->first();
            if ($result) {
                $result = json_decode(json_encode($result),true);
            }
        }
        return $result;
    }

}
