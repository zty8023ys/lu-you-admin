<?php

namespace Dengje\Gallery;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dengje\Gallery\Grid\Gallery;
use Dcat\Admin\Grid\Column;
use App\Admin\Extensions\Popover;


class GalleryServiceProvider extends ServiceProvider
{
	protected $js = [
//        'js/index.js',
        'js/viewer.js',


    ];
	protected $css = [
		'css/index.css',
        'css/viewer.css',
	];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();


        // 加载静态文件
        Admin::requireAssets('@dengje.gallery');

        // 加载插件
        Admin::booting(function () {
            Column::extend('gallery', Gallery::class);
        });


	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
