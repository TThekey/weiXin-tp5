<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 19:03
 */

namespace app\lib\execption;


use Exception; //使用基类Execption
use think\exception\Handle;
use think\Log;
use think\Request;

class ExecptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e)
    {
        if($e instanceof BaseExecption){
            //自定义的异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else{
            if(config('app_debug')) {
                //返回框架默认的错误页面
                return parent::render($e);
            }
            else{
                //内部异常，记录日志
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'errorCode' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type'  => 'File',
            'path'  => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}