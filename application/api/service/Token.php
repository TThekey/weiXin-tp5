<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/21
 * Time: 14:02
 */

namespace app\api\service;


use app\lib\execption\TokenExecption;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    //令牌是用户程序生成的随机字符串，与微信服务器无关
    public static function generateToken()
    {
        // 用三组字符串，进行md5加密 [加强安全性]
        // 1.32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        // 2.时间戳
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        // 3.盐
        $salt = config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);
    }

    //通用方法
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);

        if(!$vars){
            throw new TokenExecption();
        }
        else{
            if(!is_array($vars)){
                $vars = json_decode($vars);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }
            else{
                throw new Exception("尝试获取的Token变量并不存在");
            }
        }
    }



    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

}