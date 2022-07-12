<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    
    public function index()
    {
        return view('home');
    }

    public function clearCache()
    {
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        return view('clear-cache');
    }
    
    public function call()
    {
        \Artisan::call('berkayk/onesignal-laravel');
        // \Artisan::call('make:middleware BasicAuth');
        // \Artisan::call('composer dump-autoload');
    }
    
}
