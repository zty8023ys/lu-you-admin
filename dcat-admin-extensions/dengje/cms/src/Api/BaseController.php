<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------

namespace Dengje\Cms\Api;


class BaseController
{
    public function result($data = [],$code =200,$message='请求成功！')
    {
        return response()->json([
            'status'  => true,
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
            'time'    => time()
        ]);
    }
}
