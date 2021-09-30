<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------
namespace Dengje\Cms\Api;

use Dengje\Cms\Models\CmsCategory;
use Dengje\Cms\Models\CmsPost;

class CategoryController extends BaseController
{
    /**
     * 获取分类
     * @params field
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $field = request()->get('field','');
        if($field){
            $field = explode(',',$field);
        }else{
            $field = ['*'];
        }
        $data = CmsCategory::where('state',1)->where('parent_id',0)->orderBy('sort','asc')->get($field);
        foreach ($data  as $k=>$v){
            $data[$k]['child'] = CmsCategory::where('parent_id',$v->id)->get();
            $data[$k]['post_num'] = CmsPost::where('category_id',$v->id)->count();
        }
        return $this->result($data);
    }
}
