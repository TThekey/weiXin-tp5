<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/10
 * Time: 18:06
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\execption\BannerMissExecption;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     *
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->gocheck();
        $banner = BannerModel::getBannerByID($id);
        if(!$banner){
            throw new BannerMissExecption();
        }
        return $banner;
    }

}