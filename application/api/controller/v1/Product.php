<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/17
 * Time: 23:13
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\execption\ProductExecption;
use app\api\validate\IDMustBePositiveInt;

class Product
{
    //最新商品接口
    public function getRecent($count=15)
    {
        (new Count())->goCheck();

        $products = ProductModel::getMostRecent($count);
        if($products->isEmpty()){
            throw new ProductExecption();
        }

        //数据集对象
        $products = $products->hidden(['summary']);
        return $products;
    }


    //分类商品接口
    public function getAllInCategory($id)
    {
        (new IDMustBePositiveInt())->gocheck();
        $products = ProductModel::getProductsByCategoryID($id);

        if($products->isEmpty()){
            throw new ProductExecption();
        }
        $products = $products->hidden(['summary']);
        return $products;
    }

    //商品详情接口
    public function getOne($id)
    {
        (new IDMustBePositiveInt())->gocheck();
        $product = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductExecption();
        }
        return $product;
    }


}