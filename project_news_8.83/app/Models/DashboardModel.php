<?php

namespace App\Models;
use App\Models\AdminModel;
use DB;
class DashboardModel extends AdminModel
{
    public function countItems($params)
    {   
     
        
        $result = [];
        if (isset($params['table'])) {
            foreach ($params['table'] as $key => $value) {
                $tmp =  DB::table($value)->select(DB::raw('COUNT(id) as count'))->get()->toArray(); 
                $result[$value]  =  $tmp[0]->count;
            }
        }

        return $result;

    }

}
