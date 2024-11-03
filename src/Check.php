<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck;

abstract class Check
{
    abstract public function getName(): string;

    abstract public function check(): CheckResult;

    public function ok(?string $message = null): CheckResult
    {
        return CheckResult::ok($this->getName(), $message);
    }

    public function warning(?string $message = null): CheckResult
    {
        return CheckResult::warning($this->getName(), $message);
    }

    public function error(?string $message = null): CheckResult
    {
        return CheckResult::error($this->getName(), $message);
    }
}
