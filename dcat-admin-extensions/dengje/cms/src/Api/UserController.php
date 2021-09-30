<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Api;

use Dengje\Cms\Lib\Token\Token;
use Dengje\Cms\Lib\Utils\Utils;
use Dengje\Cms\Lib\WxBizDataCrypt\WXBizDataCrypt;
use Dengje\Cms\Models\CmsConfig;
use Dengje\Cms\Models\CmsUser;
use Illuminate\Http\Request;



class UserController extends BaseController
{
    /**
     * 通过code获取session_key
     */
    public function tocode(Request $request){
        $code = $request->data['code'];
        $appid = CmsConfig::get('appid');
        $secret = CmsConfig::get('secret');
        $data = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid='.$appid
            .'&secret='.$secret.'&js_code='.$code.'&grant_type=authorization_code');
        return $this->result(json_decode($data,true));
    }
    public function weixinLogin(Request $request){

        $appid = CmsConfig::get('appid');
        $sessionKey = $request->data['session_key'];

        $encryptedData= $request->data['en_data'];

        $iv = $request->data['iv'];

        $openid = $request->data['openid'];

        $pc = new WXBizDataCrypt($appid, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data );

        if ($errCode == 0) {
            // 判断也没有该用户

            $data = json_decode($data,true);
            if(!CmsUser::where('openid',$openid)->exists()){
                $this->registerUser($openid,$data['nickName'],$data['avatarUrl'],$data['country'],$data['province'],$data['city'],$data['gender']);

            }
            $user_id = CmsUser::where('openid',$openid)->value('id');
            return $this->result(Token::makeToken($user_id));
        } else {
            print($errCode . "\n");
        }

    }

    private function registerUser($openid,$nickName,$avatarUrl,$country,$province,$city,$gender){
        $CmsUser = new CmsUser();
        $CmsUser->openid = $openid;
        $CmsUser->nick_name = $nickName;
        $CmsUser->avatar_url = $avatarUrl;
        $CmsUser->country = $country;
        $CmsUser->province = $province;
        $CmsUser->city = $city;
        $CmsUser->gender = $gender;
        $CmsUser->save();
    }


    public function userInfo(Request $request){
        $uid = $request->uid;
        $data = CmsUser::where('id',$uid)->first();
        $data['join_time'] = Utils::format_datetime($data['created_at']);
        return $this->result($data);
    }
}
