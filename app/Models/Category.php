<?php

/**
 * Created by PhpStorm.
 * User: feimo
 * Date: 2017/5/9
 * Time: 17:32
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends  Model
{
    protected $table = 'category';
    /*
    * 获取无限极分类
    */
    public function getTree($data){
        $categoryList=$this::tree($data,'name');
        return $categoryList;
    }

    /**
     * 获得所有子栏目
     * @param $data 栏目数据
     * @param int $pid 操作的栏目
     * @param string $html 栏目名前字符
     * @param string $fieldPri 表主键
     * @param string $fieldPid 父id
     * @param int $level 等级
     * @return array
     */
    static public function channelList($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'parentid', $level = 1)
    {
        $data = self::channelLists($data, $pid, $html, $fieldPri, $fieldPid, $level);

        if (empty($data))
            return $data;
        foreach ($data as $n => $m) {
            if ($m['level'] == 1)
                continue;
            $data[$n]['first'] = false;
            $data[$n]['end'] = false;
            if (!isset($data[$n - 1]) || $data[$n - 1]['level'] != $m['level']) {
                $data[$n]['first'] = true;
            }
            if (isset($data[$n + 1]) && $data[$n]['level'] > $data[$n + 1]['level']) {
                $data[$n]['end'] = true;
            }
        }
        //更新key为栏目主键
        $category=array();
        foreach($data as $d){
            $category[$d[$fieldPri]]=$d;
        }
        return $category;
    }

    //只供channelList方法使用
    static private function channelLists($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'parentid', $level = 1)
    {
        if (empty($data))
            return array();
        $arr = array();
        foreach ($data as $v) {
            $id = $v[$fieldPri];
            if ($v[$fieldPid] == $pid) {
                $v['level'] = $level;
                $v['html'] = str_repeat($html, $level - 1);
                array_push($arr, $v);
                $tmp = self::channelLists($data, $id, $html, $fieldPri, $fieldPid, $level + 1);
                $arr = array_merge($arr, $tmp);
            }
        }
        return $arr;
    }
    /**
     * 获得树状数据
     * @param $data 数据
     * @param $title 字段名
     * @param string $fieldPri 主键id
     * @param string $fieldPid 父id
     * @return array
     */
    static public function tree($data, $title, $fieldPri = 'id', $fieldPid = 'parentid')
    {
        if (!is_array($data) || empty($data))
            return array();
        $arr = self::channelList($data, 0, '', $fieldPri, $fieldPid);
        foreach ($arr as $k => $v) {
            $str = "";
            if ($v['level'] > 2) {
                for ($i = 1; $i < $v['level'] - 1; $i++) {
                    $str .= "│&nbsp;&nbsp;&nbsp;&nbsp;";
                }
            }
            if ($v['level'] != 1) {
                $t = $title ? $v[$title] : "";
                if (isset($arr[$k + 1]) && $arr[$k + 1]['level'] >= $arr[$k]['level']) {
                    $arr[$k]['name'] = $str . "├─ " . $v['html'] . $t;
                } else {
                    $arr[$k]['name'] = $str . "└─ " . $v['html'] . $t;
                }
            } else {
                $arr[$k]['name'] = $v[$title];
            }
        }

        return $arr;
    }



}