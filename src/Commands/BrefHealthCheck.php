<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Commands;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;
use Bref\LaravelHealthCheck\Checks\CacheConnection;
use Bref\LaravelHealthCheck\Checks\DatabaseConnection;
use Bref\LaravelHealthCheck\Checks\DebugModeIsDisabled;
use Bref\LaravelHealthCheck\Checks\InternetConnectivity;
use Bref\LaravelHealthCheck\Checks\LambdaMemoryLimit;
use Bref\LaravelHealthCheck\Checks\PhpVersionIsRecentEnough;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class BrefHealthCheck extends Command
{
    protected $signature = 'bref:health-check';

    protected $description = 'Bref Health check';

    public function handle(): void
    {
        /** @var Collection<array-key, class-string<Check>> $checks */
        $checks = collect([
            PhpVersionIsRecentEnough::class,
            DebugModeIsDisabled::class,
            LambdaMemoryLimit::class,
            CacheConnection::class,
            DatabaseConnection::class,
            InternetConnectivity::class,
        ]);

        $results = $checks->map(fn (string $check): CheckResult => (new $check)->check())
            ->map(fn (CheckResult $result) => $result->toArray())
            ->toArray();

        $this->output->write(json_encode($results, JSON_THROW_ON_ERROR));
    }
}