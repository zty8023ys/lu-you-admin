<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CmsCategory extends Model
{
    use HasDateTimeFormatter;
//    use SoftDeletes;

    protected $table = 'cms_category';


    public function getIntroAttribute($key)
    {
        return $key ? $key:'这家伙很懒，未设置任何简介';
    }


}
