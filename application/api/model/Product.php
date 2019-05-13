<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/16
 * Time: 21:26
 */

namespace app\api\model;


class Product extends BaseModel
{
    //隐藏字段
    protected $hidden =[
        'delete_time','update_time','create_time','pivot','category_id','from','img_id'
    ];

    //获取器
    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    //关联product_img表（一对多）
    public function imgs()
    {
        return $this->hasMany('ProductImage','product_id','id');
    }

    //关联product_property表（一对多）
    public function properties()
    {
        return $this->hasMany('ProductProperty','product_id','id');
    }




    //查最新商品，限制数量
    public static function getMostRecent($count)
    {
        $products = self::limit($count)->order('create_time desc')->select();
        return $products;
    }

    //查分类下的商品
    public static function getProductsByCategoryID($id)
    {
        $products = self::where('category_id',$id)->select();
        return $products;
    }

    //获取商品详情
    public static function getProductDetail($id)
    {
        $product = self::with([
            'imgs' => function($query) {
                $query->with(['imgUrl'])->order('order asc');
            }
        ])
            ->with(['properties'])
            ->find($id);
        return $product;
    }


}