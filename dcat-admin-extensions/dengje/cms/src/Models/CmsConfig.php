<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------

namespace Dengje\Cms\Models;


class CmsConfig extends BaseModel
{
    public $timestamps = FALSE;
    protected $table = 'cms_config';


    public static function set($key,$value)
    {
        $settings = new CmsConfig();
        if((new CmsConfig())->where('key',$key)->exists()){

            if(is_array($value)){
                $settings->where('key',$key)->update(['value'=>json_encode($value)]);
            }else{
                $settings->where('key',$key)->update(['value'=>$value]);
            }

        }else{
            if(is_array($value)) {
                $settings->key = $key;
                $settings->value = json_encode($value);
                $settings->save();
            }else{
                $settings->key = $key;
                $settings->value = $value;
                $settings->save();
            }

        }

    }


    public static function get($key)
    {
        if((new CmsConfig())->where('key',$key)->exists()){
            $value = (new CmsConfig())->where('key',$key)->value('value');
        }else{
            $value = '';
        }


        return $value;
    }


}
