<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/16
 * Time: 21:47
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids.checkIDs' => 'ids必须是以逗号分隔的多个正整数'

    ];


    //自定义验证规则
    protected function checkIDs($value)
    {
        $values = explode(',',$value);
        if(empty($values)){
            return false;
        }
        foreach ($values as $id){
            //调用基类方法
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }


}