<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 16:00
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress','user_id','id');
    }


    public static function getByOpenID($openid)
    {
        $user = self::where('openid',$openid)->find();
        return $user;
    }

}