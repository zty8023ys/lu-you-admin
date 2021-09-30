<?php

namespace Dengje\Cms;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dengje\Cms\Http\Middleware\ApiMiddleware;



class CmsServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];

//    protected $middleware = [
//        'middle' => [ // 注册中间件
//            ApiMiddleware::class,
//        ],
//    ];




    // 注册菜单
    protected $menu = [
        [
            'title' => 'CMS管理',
            'uri'   => '',
            'icon'  => 'fa-shopping-bag',
        ],
        [
            'parent' => 'CMS管理', // 指定父级菜单
            'title'  => '轮播图',
            'uri'    => 'cms/banner',
        ],
        [
            'parent' => 'CMS管理', // 指定父级菜单
            'title'  => '分类',
            'uri'    => 'cms/category',
        ],
        [
            'parent' => 'CMS管理', // 指定父级菜单
            'title'  => '文章',
            'uri'    => 'cms/post',
        ],
        [
            'parent' => 'CMS管理', // 指定父级菜单
            'title'  => '图文导航',
            'uri'    => 'cms/nav',
        ],
        [
            'parent' => 'CMS管理', // 指定父级菜单
            'title'  => '配置',
            'uri'    => 'cms/config',
        ],
        [
        'parent' => 'CMS管理', // 指定父级菜单
        'title'  => '通知',
        'uri'    => 'cms/notice',
    ],


    ];

	public function register()
	{
		//
        $this->loadRoutesFrom(__DIR__ . '/Http/api.php');
	}

	public function init()
	{
		parent::init();

		//

	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
