<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/5/2
 * Time: 16:08
 */

namespace app\api\controller\v1;


use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\execption\SuccessMessage;
use app\lib\execption\UserExecption;

class Address
{
    public function createOrUpdateAddress()
    {
        $validate = new AddressNew();
        $validate->goCheck();

        $uid = TokenService::getCurrentUid();

        $user = UserModel::get($uid);
        if(!$user){
            throw new UserExecption();
        }


        $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;
        if(!$userAddress){
            $user->address()->save($validate);
        }
        else{
            $user->address->save($validate);
        }

        return json(new SuccessMessage(),201);

    }

}