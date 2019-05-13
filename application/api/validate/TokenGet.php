<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 15:47
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isMotEmpty'
    ];

    protected $message = [
        'code.isMotEmpty' => 'code不允许传空值'
    ];

}