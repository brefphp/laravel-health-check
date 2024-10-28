<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;
use Illuminate\Support\Facades\Http;
use Throwable;

class InternetConnectivity extends Check
{
    public function getName(): string
    {
        return 'Internet connectivity';
    }

    public function check(): CheckResult
    {
        try {
            $status = Http::timeout(3)
                ->connectTimeout(3)
                ->get('https://google.com')
                ->successful();
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }

        return $status ? $this->ok() : $this->error();
    }
}
