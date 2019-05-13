<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    //隐藏字段
    protected $hidden =['id','from','delete_time','update_time'];

    //读取器，修改本地图片url地址
    public function getUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

}
