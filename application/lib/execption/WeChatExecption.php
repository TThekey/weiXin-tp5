<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 21:10
 */

namespace app\lib\execption;


class WeChatExecption extends BaseExecption
{
    public $code = 404;
    public $msg = '微信服务器接口调用失败';
    public $errorCode = 999;
}