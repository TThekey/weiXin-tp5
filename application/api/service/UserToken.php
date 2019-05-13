<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/20
 * Time: 16:01
 */

namespace app\api\service;


use app\lib\execption\TokenExecption;
use app\lib\execption\WeChatExecption;
use think\Config;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = Config::get('wx.app_id');
        $this->wxAppSecret = Config::get('wx.app_secret');
        $this->wxLoginUrl = sprintf(Config::get('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);

    }

    public function get()
    {
        //请求微信服务器拿openid
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception("获取openID异常，微信内部错误");
        }
        else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginErr($wxResult);
            }
            else{
                return $this->grantToken($wxResult);
            }
        }
    }

    //抛出异常
    private function processLoginErr($wxResult)
    {
        throw new  WeChatExecption(
            [
                'msg'       => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode'],
            ]
        );
    }

    //生成Token令牌
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        //得到uid
        if($user){
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }

        //准备缓存数据，写入缓存
        $cacheValue = $this->prepareCachedValue($wxResult, $uid);

        $token = $this->saveToCache($cacheValue);
        return $token;

    }

    //写入缓存，返回token令牌
    private function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        // 设置缓存失效时间
        $expire_in = config('setting.token_expire_in');

        $request = cache($key, $value, $expire_in);
        if (!$request) {
            // 令牌缓存出错
            throw new TokenExecption([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }


    //准备缓存数据
    private function prepareCachedValue($wxResult, $uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;

        return $cacheValue;

    }


    //插入一条用户
    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;

    }

}