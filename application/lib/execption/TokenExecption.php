<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/21
 * Time: 14:42
 */

namespace app\lib\execption;


class TokenExecption extends BaseExecption
{
    public $code = 401;
    public $msg = 'Token已过期或Token无效';
    public $errorCode = 10001;

}