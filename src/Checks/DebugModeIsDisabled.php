<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;
use Illuminate\Support\Facades\Config;

class DebugModeIsDisabled extends Check
{
    public function getName(): string
    {
        return 'Debug mode is disabled';
    }

    public function check(): CheckResult
    {
        return Config::get('app.debug') ? $this->error() : $this->ok();
    }
}
