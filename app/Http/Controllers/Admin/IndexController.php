<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Admin\BasicController;
class IndexController extends BasicController
{
    protected function index()
    {

        $list= DB::table('article')->select('*')->get();
        return view('/admin/index/index',['list'=>$list]);

    }

    public function main(){
        return view('/admin/index/main');
    }




}
