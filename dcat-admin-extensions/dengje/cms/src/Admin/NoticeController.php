<?php

namespace Dengje\Cms\Admin;


use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dengje\Cms\Models\CmsNotice;


class NoticeController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->title('通知')
            ->description('通知列表')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CmsNotice(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title','标题')->editable();
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
        return Show::make($id, new CmsNotice(), function (Show $show) {
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
        return Form::make(new CmsNotice(), function (Form $form) {
            $form->display('id');
            $form->text('title','标题');
            $form->editor('content','内存');


            $form->number('sort','排序');
            $form->switch('state','状态');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
