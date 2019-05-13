<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/5/2
 * Time: 20:29
 */

namespace app\lib\execption;


class UserExecption extends BaseExecption
{
    public $code = 404;
    public $msg = "用户不存在";
    public $errorCode = 60000;
}