<?php

namespace app\api\model;

use think\Model;

class BannerItem extends BaseModel
{
    //隐藏字段
    protected $hidden =['id','img_id','banner_id','delete_time','update_time'];

    //关联image模型（一对一）
    public function img()
    {
        //主表关联从表
        return $this->belongsTo('Image','img_id','id');
    }
}
