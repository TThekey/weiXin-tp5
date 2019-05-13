<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 0:27
 */

namespace app\lib\execption;


class CategoryExecption extends BaseExecption
{
    public $code = 404;
    public $msg = '指定类别不存在，请检查参数';
    public $errorCode = 50000;
}