<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 22:03
 */

namespace app\lib\execption;


class ParameterExecption extends BaseExecption
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;

}