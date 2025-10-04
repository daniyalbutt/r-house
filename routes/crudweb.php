<?php

use App\Http\Controllers\Admin\BlogsController;
Route::resource('admin/blogs', BlogsController::class);
use App\Http\Controllers\Admin\FaqsController;
Route::resource('admin/faqs', FaqsController::class);