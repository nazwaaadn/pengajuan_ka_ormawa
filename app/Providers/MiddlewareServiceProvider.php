<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckSubmissionAccess;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Mendaftarkan middleware ke router
        $this->app['router']->aliasMiddleware('check.submission.access', CheckSubmissionAccess::class);
    }
}
