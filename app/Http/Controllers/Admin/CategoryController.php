<?php
/**
 * Created by PhpStorm.
 * User: feimo
 * Date: 2017/5/9
 * Time: 14:13
 */

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Admin\BasicController;

class CategoryController extends BasicController
{
    //分类列表
    public function index(Request $request, Category $category)
    {
        //获取分类Tree
        $list = $category::all()->toArray();
        $list = $category->getTree($list);
        return view('/admin/category/index', ['list' => $list]);

    }

    //添加分类
    public function addCategory(Request $request, Category $category)
    {
        //获取分类Tree
        $list = $category::all()->toArray();
        $list = $category->getTree($list);
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $info = DB::table('category')->where(['name' => $data['name']])->first();
            if (!empty($info)) {
                echo 1;
                die;
            }
            $id = DB::table('category')->insertGetId($data);
            if ($id) {
                echo 'ok';
                die;
            }

        }
        return view('/admin/category/addcategory', ['list' => $list]);
    }

    //编辑分类
    public function editCategory(Request $request, Category $category)
    {
        $id = $request->id;
        $info = $category::where('id', $id)->first();
        //如果不存在这个分类 就跳转到列表页面
        if(empty($info)){
            return redirect()->route('feimo/category');
        }
        //获取分类Tree
        $list = $category::all()->toArray();
        $list = $category->getTree($list);
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            DB::table('category')->where('id', $id)->update($data);
            echo 'ok';
            die;

        }
        return view('/admin/category/editcategory', ['list' => $list,'info'=>$info,'id'=>$id]);

    }


    //删除分类
    public function delCategory(Request $request, Category $category){
        $id = $request->id;
        $info = $category::where('id', $id)->first();
        //如果不存在这个分类 就跳转到列表页面
        if(empty($info)){
            return redirect()->route('feimo/category');
        }
        $list=$category::where('parentid', $info->id)->first();
        if(!empty($list)){
            echo '1';die;
        }
        $msg=DB::table('category')->where('id', $id)->delete();
        if($msg){
            echo 'ok';die;
        }
    }


}
