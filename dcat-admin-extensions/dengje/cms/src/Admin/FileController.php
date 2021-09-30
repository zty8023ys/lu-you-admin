<?php
// +----------------------------------------------------------------------
// | 柚枝集 [资讯小程序]
// +----------------------------------------------------------------------
// | Copyright (c) 2021 https://www.pipyou.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 爱喝啤酒的友 <luckyoupan@163.com>
// +----------------------------------------------------------------------

namespace Dengje\Cms\Admin;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Traits\HasUploadedFile;

use Dcat\Admin\Http\JsonResponse;

class FileController extends AdminController
{
    use HasUploadedFile;
    public function handle()
    {
        $disk = $this->disk(env('FILESYSTEM_DRIVER'));

        // 判断是否是删除文件请求
        if ($this->isDeleteRequest()) {
            // 删除文件并响应
            return $this->deleteFileAndResponse($disk);
        }

        // 获取上传的文件
        $file = $this->file();

        // 获取上传的字段名称
        $column = $this->uploader()->upload_column;

        $dir = date('Y/m/d');
        $newName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $result = $disk->putFileAs($dir, $file, $newName);

        $path = "{$dir}/$newName";
        $url = $disk->url($path);

        return  $result ? ['data'=>[
                'id'=> $url,
                'name'=>$newName,
                'path'=>$path,
                'url'=>$url
            ],'status'=>true]
            : $this->responseErrorMessage('文件上传失败');
    }


    public function delete(Content $content)
    {
        return JsonResponse::make()->success('成功')->refresh();
    }


}
