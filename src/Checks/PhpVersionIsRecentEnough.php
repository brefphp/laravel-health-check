<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;

class PhpVersionIsRecentEnough extends Check
{
    public function getName(): string
    {
        return 'PHP version is recent enough';
    }

    public function check(): CheckResult
    {
        if (PHP_VERSION_ID < 80100) {
            return $this->error('PHP version is no longer supported, upgrade to PHP 8.1 or newer');
        }

        return $this->ok();
    }
}
