<?php
/**
 * Created by PhpStorm.
 * User: GYW
 * Date: 2019/4/16
 * Time: 21:27
 */

namespace app\api\model;


class Theme extends BaseModel
{
    //隐藏字段
    protected $hidden =['delete_time','update_time','head_img_id','topic_img_id'];

    //关联img表(topic_img_id)
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    //关联img表(head_img_id)
    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }

    //关联product表（多对多）
    public function products()
    {
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    //theme列表带图片
    public static function getThemeWithImages($ids)
    {
        $themes = self::with('topicImg,headImg')->select($ids);
        return $themes;

    }

    //theme详情页(带product)
    public static function getThemeWithProducts($id)
    {
        $theme = self::with('products,topicImg,headImg')->find($id);
        return $theme;

    }




}