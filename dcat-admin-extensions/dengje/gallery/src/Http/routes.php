<?php

use Dengje\Gallery\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('gallery', Controllers\GalleryController::class.'@index');