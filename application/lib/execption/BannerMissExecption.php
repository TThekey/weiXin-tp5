<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 19:08
 */

namespace app\lib\execption;


class BannerMissExecption extends BaseExecption
{
    public $code = 404;
    public $msg = '请求的banner不存在';
    public $errorCode = 40000;
}