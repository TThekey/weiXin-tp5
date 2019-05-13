<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 18:52
 */

namespace app\api\model;


use think\Model;

class Banner extends BaseModel
{
    //隐藏字段
    protected $hidden =['delete_time','update_time'];

    //关联BannerItem模型（一对多）
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }


    public static function getBannerByID($id)
    {
        //关联（嵌套关联）
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }

}