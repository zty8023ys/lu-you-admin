<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Lib\Token;
use Illuminate\Support\Facades\Cache;




class Token
{

    /**
     * 生成token
     * $key
     */
    public static function makeToken($key){
        $v = 'cms';
        $hash = md5($key . $v . mt_rand() . time());
        $token = str_replace('=', '', base64_encode($hash));
        Cache::add('token_'.$token, $key, 10080);
        return [
            'token'=>$token,
        ];
    }

    /**
     * 判断token
     */
    public static function hasToken($token){
        if (!Cache::has('token_'.$token)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 获取token
     */
    public static function getToken($token){
        $value = Cache::get('token_'.$token);
        return $value;
    }

}
