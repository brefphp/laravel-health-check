<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck\Checks;

use Bref\LaravelHealthCheck\Check;
use Bref\LaravelHealthCheck\CheckResult;

class LambdaMemoryLimit extends Check
{
    public function getName(): string
    {
        return 'Memory available is sufficient';
    }

    public function check(): CheckResult
    {
        $memoryAvailableInMb = (int) ($_SERVER['AWS_LAMBDA_FUNCTION_MEMORY_SIZE'] ?? 0);
        $recommendedMemory = 1024;

        if ($memoryAvailableInMb < $recommendedMemory) {
            return $this->warning("The memory limit configured is $memoryAvailableInMb MB, but $recommendedMemory MB is recommended.");
        }

        return $this->ok();
    }
}
