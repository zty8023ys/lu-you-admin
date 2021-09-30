<?php
namespace Dengje\Gallery\Grid;


use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Displayers\AbstractDisplayer;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Storage;

class Gallery extends AbstractDisplayer
{
    public function display($server='',$width=100,$height='')
    {

        if ($this->value instanceof Arrayable) {
            $this->value = $this->value->toArray();
        }


            if (url()->isValidUrl($this->value) || mb_strpos($this->value, 'data:image') === 0) {
                $src = $this->value;
            } elseif ($server) {
                $src = rtrim($server, '/') . '/' . ltrim($this->value, '/');
            } else {
                $src = Storage::disk(config('admin.upload.disk'))->url($this->value);
            }



        return Admin::view('dengje.gallery::gallery', ['src' => $src, 'width' => $width, 'height' => $height]);



    }
}

