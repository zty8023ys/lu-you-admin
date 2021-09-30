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

class CmsNav extends BaseModel
{
    use HasDateTimeFormatter;
//    use SoftDeletes;

    protected $table = 'cms_nav';

    public $typeOptions = [
        0=>'小程序内',
        1=>'跳网页',
        2=>'跳小程序'
    ];


    protected $fillable = ['name'];
}
