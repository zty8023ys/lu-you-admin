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
use Illuminate\Http\Request;

class TagController extends AdminController
{
    public function save(Request $request){
        $tagName = $request->name;
        if(!(CmsTag::where('name',$tagName)->exists())){
            $tag = CmsTag::firstOrCreate(['name'=>$tagName]);
//            $id = $tag->id;
//            array_push($insertedIds, $id);

        }else{
//            $id = CmsTag::where('name',$v)->value('id');
//            array_push($insertedIds, $id);
        }
    }
}
