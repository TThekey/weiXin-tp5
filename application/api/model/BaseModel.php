<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //供子类img模型读取器调用
    protected function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] == 1){
            //处理本地的图片
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
