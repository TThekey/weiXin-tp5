<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/16
 * Time: 21:26
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\Theme as ThemeModel;
use app\lib\execption\ThemeExecption;

class Theme
{

    /**
     * @url /theme?ids=id1,id2...
     * @return 一组theme模型
     */
    public function getSimpleList($ids = '')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $theme = ThemeModel::getThemeWithImages($ids);
        if($theme->isEmpty()){
            throw new ThemeExecption();
        }
        return $theme;
    }

    /**
     * @url /theme/id
     * @return 某一主题的相关产品和图片
     */
    public function getComplexOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        if(!$theme){
            throw new ThemeExecption();
        }
        return $theme;
    }

}