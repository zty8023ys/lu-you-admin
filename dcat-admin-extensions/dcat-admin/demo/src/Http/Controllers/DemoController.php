<?php

namespace DcatAdmin\Demo\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class DemoController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('dcat-admin.demo::index'));
    }
}