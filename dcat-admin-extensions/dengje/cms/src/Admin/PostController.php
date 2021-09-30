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
use Dcat\Admin\Support\Helper;
use Dengje\Cms\Models\CmsCategory;
use Dengje\Cms\Models\CmsPost;
use Dengje\Cms\Models\CmsTag;
use Illuminate\Http\Request;

class PostController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->title('文章')
            ->description('CMS文章')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(CmsPost::with(['category']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('thumb','主图')->image('',60);
            $grid->column('title','文章')->limit(20);
            $grid->column('category.name','分类');

            $grid->column('post_hits','查看数');
            $grid->column('post_favorites','收藏数');
            $grid->column('post_like','点赞数');
            $grid->column('sort','排序')->editable();
            $grid->column('state','状态')->switch();
            $grid->column('is_videoad','是否开启激励视频')->switch();
            $grid->column('is_top','是否置顶')->switch();
            $grid->column('recommended','是否推荐')->switch();
            $grid->column('created_at');


            $grid->fixColumns(1);
            $grid->model()->orderBy('id', 'desc');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('name');


            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new CmsCategory(), function (Show $show) {
            $show->field('id');
            $show->field('name','分类名称');
            $show->field('state','状态');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new CmsPost(), function (Form $form) {

            $form->display('id');
            $form->text('title','标题');
            $form->textarea('intro','摘要');
            $form->image('thumb','缩略图')->uniqueName()->saveFullUrl()->retainable();
            $form->select('category_id','分类')->options(CmsCategory::pluck('name','id'));
            $form->tags('tag', '文章标签')->saving(function ($tag) {


                // 最终转化为json保存到数据库
                return json_encode($tag);

            });

            $form->editor('content','内容');
            $form->switch('is_top','是否置顶');
            $form->switch('recommended','是否推荐');
            $form->number('sort','排序');
            $form->switch('is_videoad','是否开启激励视频');
            $form->switch('state','状态');
            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function (Form $form) {
                // 判断是否是新增操作
                if ($form->isCreating()) {

                }


            });



        });
    }


//    public function save(Request $request){
//        $tags = $request['tags'];
//
//
//        // 把存在的标签去掉并保存
//        $insertedIds = [];
////        foreach ($tags as &$v){
////            if(!(CmsTag::where('name',$v)->exists())){
////                $tag = CmsTag::firstOrCreate(['name'=>$v]);
////                $id = $tag->id;
////                array_push($insertedIds, $id);
////
////            }else{
////                $id = CmsTag::where('name',$v)->value('id');
////                array_push($insertedIds, $id);
////            }
////        }
//
//        CmsPost::firstOrCreate([
//            'title' => $request['title'],
//            'thumb' => $request['thumb'],
//            'tags' => implode(',',$insertedIds),
//            'content' => $request['content'],
//            'category_id' => $request['category_id'],
//            'is_top' => $request['is_top'],
//            'state' => $request['state'],
//        ]);
//
//
//        return $insertedIds;
//
//    }
}
