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

class CmsPost extends BaseModel
{
    use HasDateTimeFormatter;
//    use SoftDeletes;

    protected $table = 'cms_post';

    protected $fillable = ['title','thumb','tags','content','category_id','state'];

    //追加字段
    protected $appends = ['format_date'];

    public function category(){
        return $this->hasOne(CmsCategory::class,'id','category_id');
    }


    public function getTagAttribute($v){
        return json_decode($v,true);
    }


    public function getFormatDateAttribute($v)
    {
        return date("m月d日",strtotime($this->created_at));
    }




    }
