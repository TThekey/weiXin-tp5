<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/21
 * Time: 17:01
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden = [ 'product_id','delete_time','update_time' ];

}