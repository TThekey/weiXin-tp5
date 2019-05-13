<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/21
 * Time: 16:59
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = [ 'img_id','delete_time','product_id' ];

    //关联img（一对一）
    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }

}