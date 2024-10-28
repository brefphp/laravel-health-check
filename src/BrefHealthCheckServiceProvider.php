<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck;

use Bref\LaravelHealthCheck\Commands\BrefHealthCheck;
use Illuminate\Support\ServiceProvider;

class BrefHealthCheckServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->commands([
            BrefHealthCheck::class,
        ]);
    }
}