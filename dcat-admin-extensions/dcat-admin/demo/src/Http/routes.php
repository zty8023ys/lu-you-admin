<?php

use DcatAdmin\Demo\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('demo', Controllers\DemoController::class.'@index');