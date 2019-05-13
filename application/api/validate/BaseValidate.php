<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 18:30
 */

namespace app\api\validate;


use app\lib\execption\ParameterExecption;
use think\Validate;
use think\Request;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        //对这些参数做校验
        $request = Request::instance();
        $params = $request->param();

        //对多个参数进行验证（batch()）
        $result = $this->batch()->check($params);
        if(!$result){
            //抛出参数异常错误
            $e = new ParameterExecption([
                'msg' => $this->error
            ]);
            throw $e;
        }
        else{
            return true;
        }
    }

    //判断id是否是正整数
    protected function isPositiveInteger($value, $rule = '',$data = '',$field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        else{
            return false;
        }
    }

    //判断是否为空值
    protected function isNotEmpty($value, $rule = '',$data = '',$field = '')
    {
        if(empty($value)){
            return false;
        }
        else{
            return true;
        }
    }

    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
    }


    public function getDataByRule($arrays)
    {
        if(array_key_exists('user_id',$arrays)| (array_key_exists('uid',$arrays))){
            throw new ParameterExecption([
                'msg' => '参数中包含非法的参数名user_id或uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key=>$value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }

}