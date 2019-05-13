<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 15:46
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code='')
    {
        (new TokenGet())->goCheck();

        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token
        ];
    }

}