<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/16
 * Time: 22:28
 */

namespace app\lib\execption;


class ThemeExecption extends BaseExecption
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}