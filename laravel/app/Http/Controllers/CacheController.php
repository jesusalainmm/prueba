<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function index()
    {
        Artisan::call('config:clear');
        echo Artisan::output();
        Artisan::call('config:cache');
        echo Artisan::output();
        Artisan::call('cache:clear');
        echo Artisan::output();
        Artisan::call('route:clear');
        echo Artisan::output();
        Artisan::call('view:clear');
        echo Artisan::output();
    }
}
