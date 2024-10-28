<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;
use Illuminate\Support\Facades\DB;
use Throwable;

class DatabaseConnection extends Check
{
    public function getName(): string
    {
        return 'Database connection';
    }

    public function check(): CheckResult
    {
        try {
            DB::connection()->getPdo();

            return $this->ok();
        } catch (Throwable $exception) {
            return $this->error("Could not connect to the database: `{$exception->getMessage()}`");
        }
    }
}
