<?php

namespace Dengje\Gallery\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('dengje.gallery::index'));
    }
}