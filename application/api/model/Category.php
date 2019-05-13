<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/18
 * Time: 23:54
 */

namespace app\api\model;


class Category extends BaseModel
{
    //隐藏字段
    protected $hidden =['delete_time','update_time','topic_img_id'];

    //关联img表（一对一）
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

}