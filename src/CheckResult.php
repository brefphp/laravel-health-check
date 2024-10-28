<?php declare(strict_types=1);

namespace Bref\LaravelHealthCheck;

class CheckResult
{
    private const STATUS_OK = 'ok';
    private const STATUS_WARNING = 'warning';
    private const STATUS_ERROR = 'error';

    /** @readonly */
    public string $name;
    /** @readonly */
    public string $status;
    /** @readonly */
    public ?string $message;

    public function __construct(string $name, string $status, ?string $message = null)
    {
        $this->name = $name;
        $this->status = $status;
        $this->message = $message;
    }

    public static function ok(string $name, ?string $message = null): self
    {
        return new self($name, self::STATUS_OK, $message);
    }

    public static function warning(string $name, ?string $message = null): self
    {
        return new self($name, self::STATUS_WARNING, $message);
    }

    public static function error(string $name, ?string $message = null): self
    {
        return new self($name, self::STATUS_ERROR, $message);
    }

    /**
     * @return array{status: string, name: string, message: string|null}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'message' => $this->message,
        ];
    }
}
