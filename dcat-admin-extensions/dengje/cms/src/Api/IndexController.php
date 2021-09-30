<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Api;

use Dengje\Cms\Models\CmsBanner;
use Dengje\Cms\Models\CmsCategory;
use Dengje\Cms\Models\CmsConfig;
use Dengje\Cms\Models\CmsNav;
use Dengje\Cms\Models\CmsTeam;
use Dengje\Cms\Models\CmsNotice;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * 获取轮播图
     * @params field
     * @return \Illuminate\Http\JsonResponse
     */
    public function banner(){
        $field = request()->get('field','');
        if($field){
            $field = explode(',',$field);
        }else{
            $field = ['*'];
        }
        $data = CmsBanner::where('state',1)->orderBy('sort','asc')->get($field);

        return $this->result($data);
    }

    /**
     * 图文导航栏
     * @return \Illuminate\Http\JsonResponse
     */
    public function nav(){
        $data = CmsNav::where('state',1)->orderBy('sort','asc')->get();
        return $this->result($data);
    }

    /**
     * 获取配置
     * @return \Illuminate\Http\JsonResponse
     */
    public function config(){
        $data = [
            'weixin' => CmsConfig::get('weixin'),
            'phone'  => CmsConfig::get('phone'),
            'rewarded_video_ad'=>CmsConfig::get('rewarded_video_ad'),
            'loading_img'=>CmsConfig::get('loading_img'),
            'index_banner_height'=>CmsConfig::get('index_banner_height'),
        ];
        return $this->result($data);
    }


    /**
     * 获取通知
     * @return \Illuminate\Http\JsonResponse
     */
    public function firstNotice(Request $request){
        $id = $request->id;
        if($id){
            $data = CmsNotice::where('state',1)->where('id',$id)->orderBy('sort','asc')->orderBy('created_at','desc')->first(['id','title','content']);

        }else{
            $data = CmsNotice::where('state',1)->orderBy('sort','asc')->orderBy('created_at','desc')->first(['id','title','content']);

        }
        return $this->result($data);
    }


    /**
     * 获取通知列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function notice(Request $request){
        $data = CmsNotice::where('state',1)->orderBy('sort','asc')->orderBy('created_at','desc')->get(['id','title']);
        return $this->result($data);
    }

    /**
     * 获取指定配置
     * @return \Illuminate\Http\JsonResponse
     */
    public function configByKey(Request $request){
        $key = $request->configKey;

        $data[$key] = CmsConfig::get($key);
        return $this->result($data);
    }


    public function team(){
        $data = CmsTeam::where('state',1)->get();
        return $this->result($data);
    }





}
