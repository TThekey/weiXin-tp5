<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/17
 * Time: 23:31
 */

namespace app\lib\execption;


class ProductExecption extends BaseExecption
{
    public $code = 404;
    public $msg = '指定的商品不存在，请检查参数';
    public $errorCode = 20000;
}