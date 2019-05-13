<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/17
 * Time: 23:17
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];

    protected $message = [
        'count.isPositiveInteger' => 'count必须是正整数'
    ];

}