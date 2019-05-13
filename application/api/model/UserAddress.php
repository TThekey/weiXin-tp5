<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/5/2
 * Time: 22:55
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id','delete_time','user_id'];
}