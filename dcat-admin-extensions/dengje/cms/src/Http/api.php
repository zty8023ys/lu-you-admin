<?php
use Dengje\Cms\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Dengje\Cms;

Route::get('cms/aa', function (){
    return 1;
});


// 分类
Route::get('api/cms/category',Cms\Api\CategoryController::class.'@index');
// 文章列表
Route::get('api/cms/post',Cms\Api\PostController::class.'@index');
// 推荐文章
Route::get('api/cms/post/recommend',Cms\Api\PostController::class.'@recommend');
// 猜你喜欢
Route::get('api/cms/post/youlike',Cms\Api\PostController::class.'@youlike');
// 详情
Route::get('api/cms/post/detail',Cms\Api\PostController::class.'@detail');
// 轮播图
Route::get('api/cms/banner',Cms\Api\IndexController::class.'@banner');
// 图文导航栏
Route::get('api/cms/nav',Cms\Api\IndexController::class.'@nav');
// 通过分类id获取文章列表
Route::get('api/cms/getPostByCategory',Cms\Api\PostController::class.'@getPostByCategory');
// 获取配置
Route::get('api/cms/config',Cms\Api\IndexController::class.'@config');
// 获取一条通知
Route::get('api/cms/firstNotice',Cms\Api\IndexController::class.'@firstNotice');
// 获取通知列表
Route::get('api/cms/notice',Cms\Api\IndexController::class.'@notice');
// 获取指定配置
Route::get('api/cms/config/configByKey',Cms\Api\IndexController::class.'@configByKey');
// 团队
Route::get('api/cms/team',Cms\Api\IndexController::class.'@team');

// 通过code获取session_key
Route::post('api/cms/user/tocode',Cms\Api\UserController::class.'@tocode');
// 微信小程序登录
Route::post('api/cms/user/weixinLogin',Cms\Api\UserController::class.'@weixinLogin');


// 需要登录
Route::middleware(Cms\Http\Middleware\ApiMiddleware::class)->group(function () {
    Route::get('api/cms/userinfo',Cms\Api\UserController::class.'@userInfo');


});



