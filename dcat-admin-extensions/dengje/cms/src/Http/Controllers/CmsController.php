<?php

namespace Dengje\Cms\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class CmsController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('dengje.cms::index'));
    }
}