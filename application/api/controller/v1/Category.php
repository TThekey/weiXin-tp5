<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/18
 * Time: 23:53
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\execption\CategoryExecption;

class Category
{
    //分类接口
    public function getAllCategories()
    {
        $categories = CategoryModel::with('img')->select();
        if($categories->isEmpty()){
            throw new CategoryExecption();
        }
        return $categories;
    }

}