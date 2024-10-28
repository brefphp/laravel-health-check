<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CacheConnection extends Check
{
    public function getName(): string
    {
        return 'Cache connection';
    }

    public function check(): CheckResult
    {
        if (! $this->canWriteValuesToCache()) {
            return $this->error();
        }

        return $this->ok();
    }

    protected function canWriteValuesToCache(): bool
    {
        $value = Str::random(5);
        $key = "bref:health-check-$value";

        Cache::put($key, $value, 10);
        $actualValue = Cache::get($key);
        Cache::forget($key);

        return $actualValue === $value;
    }
}
