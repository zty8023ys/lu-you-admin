<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------

namespace Dengje\Cms\Admin;


use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\JsonResponse;
use Dengje\Cms\Models\CmsConfig;
use Illuminate\Http\Request;

class ConfigController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->title('配置')
            ->description('CMS配置')
            ->body($this->form());
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {


            $form = new Form();
            $form->disableResetButton();
            $form->tab('基本配置', function (Form $form) {

                    // 值为1和4时显示文本框

                    $form->text('appid', 'APPID')->value(CmsConfig::get('appid'));
                    $form->text('secret', 'SECRET')->value(CmsConfig::get('secret'));
                    $form->image('login_bg','登录背景图')->url('cms/files')->autoUpload()->saveFullUrl()->value(CmsConfig::get('login_bg'))->retainable();
                    $form->text('weixin', '微信号')->value(CmsConfig::get('weixin'));
                    $form->image('loading_img','懒加载图片')->url('cms/files')->autoUpload()->saveFullUrl()->value(CmsConfig::get('loading_img'))->retainable();
                    $form->text('index_banner_height', '首页轮播图高')->value(CmsConfig::get('index_banner_height'));
                    $form->editor('about', '关于')->value(CmsConfig::get('about'));
                    $form->editor('privacy_agreement', '用户隐私协议')->value(CmsConfig::get('privacy_agreement'));

        });
        $form->tab('流量主配置', function (Form $form) {

            // 值为1和4时显示文本框
            $form->text('rewarded_video_ad', '激励式广告ID')->value(CmsConfig::get('rewarded_video_ad'));


        });





            $form->action('cms/save_config');
            return $form;



    }


    public function saveConfig(Request $request){
        $appid = $request->appid;
        $secret = $request->secret;
        $login_bg = $request->login_bg;
        $weixin = $request->weixin;
        $loading_img = $request->loading_img;
        $index_banner_height = $request->index_banner_height;
        $about = $request->about;
        $privacy_agreement = $request->privacy_agreement;
        $rewarded_video_ad = $request->rewarded_video_ad;

        CmsConfig::set('appid',$appid);
        CmsConfig::set('secret',$secret);
        CmsConfig::set('login_bg',$login_bg);
        CmsConfig::set('weixin',$weixin);
        CmsConfig::set('index_banner_height',$index_banner_height);
        CmsConfig::set('loading_img',$loading_img);
        CmsConfig::set('about',$about);
        CmsConfig::set('privacy_agreement',$privacy_agreement);
        CmsConfig::set('rewarded_video_ad',$rewarded_video_ad);


        return JsonResponse::make()->success('成功！');
    }


}
