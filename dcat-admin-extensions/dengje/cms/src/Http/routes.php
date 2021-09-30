<?php

use Dengje\Cms\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Dengje\Cms;

Route::put('file/delete',Cms\Admin\FileController::class.'@delete');


Route::get('cms', Controllers\CmsController::class.'@index');


// 文件上传
Route::any('cms/files', Cms\Admin\FileController::class.'@handle');

// 轮播图
Route::resource('cms/banner',Cms\Admin\BannerController::class);
// 分类
Route::resource('cms/category',Cms\Admin\CategoryController::class);
// 文章
Route::resource('cms/post',Cms\Admin\PostController::class);
// 文章
Route::resource('cms/nav',Cms\Admin\NavController::class);
// 通知
Route::resource('cms/notice',Cms\Admin\NoticeController::class);
//Route::post('cms/post/save',Cms\Admin\PostController::class.'@save');
// 配置
Route::resource('cms/config',Cms\Admin\ConfigController::class);
// 保存配置
Route::post('cms/save_config',Cms\Admin\ConfigController::class.'@saveConfig');

// 团队
Route::resource('cms/team',Cms\Admin\TeamController::class);

// 保存标签
Route::post('cms/tag/save',Cms\Admin\TagController::class.'@save');



