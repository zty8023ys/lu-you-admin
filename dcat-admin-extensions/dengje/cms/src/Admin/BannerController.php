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
use Dengje\Cms\Models\CmsBanner;
use Dengje\Cms\Models\CmsCategory;

class BannerController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->title('轮播')
            ->description('轮播图')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CmsBanner(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('pic','轮播图')->image();
            $grid->column('pic','轮播图')->gallery();
            $grid->column('name','名称')->editable();
            $grid->column('path','路径');
            $grid->column('path_type','类型')
                ->using((new CmsBanner())->typeOptions)
                ->label([
                    0 => 'primary',
                    1 => 'danger',
                    2 => 'success',
                ]);
            $grid->column('sort','排序')->editable();

            $grid->column('state','状态')->switch();
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
        return Form::make(new CmsBanner(), function (Form $form) {
            $form->display('id');
            $form->image('pic','图片')->uniqueName()->saveFullUrl()->autoUpload()->retainable();
            $form->text('name','名称');
            $form->text('appid','APPID');
            $form->text('path','路径');
            $form->select('path_type','类型')->options((new CmsBanner())->typeOptions);
            $form->number('sort','排序');
            $form->switch('state','状态');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
