<?php


use think\Route;

//banner接口
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

//theme接口(获取列表)
Route::get('api/:version/theme','api/:version.Theme/getSimpleList');

//theme接口（获取产品）
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

////product接口（获取最新产品）
//Route::get('api/:version/product/recent','api/:version.Product/getRecent');
////product接口（获取分类下的商品）
//Route::get('api/:version/product/by_category','api/:version.Product/getAllInCategory');
////product接口（获取商品详情）
//Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);

Route::group('api/:version/product',function (){
    //product接口（获取最新产品）
    Route::get('/recent','api/:version.Product/getRecent');
    //product接口（获取分类下的商品）
    Route::get('/by_category','api/:version.Product/getAllInCategory');
    //product接口（获取商品详情）
    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
});


//categoary接口（获取所有分类）
Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

//Token接收与处理
Route::post('api/:version/token/user','api/:version.Token/getToken');


Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');


