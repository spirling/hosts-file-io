<?php


namespace Spirling\HostsFileManager;

use JetBrains\PhpStorm\Pure;
use Spirling\HostsFileManager\Contract\IP as IPContract;
use InvalidArgumentException;
use RuntimeException;

class IP implements IPContract
{

    protected static array $cache = [];

    protected string $string;

    protected int $version;

    protected string $packed;

    /**
     * @inheritDoc
     */
    public static function fromString(string $string): static
    {
        $filtered = filter_var($string, FILTER_VALIDATE_IP);
        if ($filtered === false) {
            throw new InvalidArgumentException('Invalid IP-address');
        } else {
            if (array_key_exists($filtered, self::$cache)) {
                return self::$cache[$filtered];
            } else {
                $version = str_contains($filtered,':') ? self::IPV6 : self::IPV4;
                return self::$cache[$filtered] = new static($filtered, $version);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public static function fromPacked(string $packed): static
    {
        $normal = inet_ntop($packed);
        if ($normal === false) {
            throw new RuntimeException('Could not convert packed data into IP-address');
        }
        $instance = static::fromString($normal);
        $instance->packed = $packed;
        return $instance;
    }

    /**
     * IP constructor.
     * @param string $string
     * @param int $version
     * @param string|null $packed
     */
    #[Pure]
    protected function __construct(string $string, int $version, string $packed = null)
    {
        $this->string = $string;
        $this->version = $version;
        if (!is_null($packed)) {
            $this->packed = $packed;
        }
    }

    /**
     * @inheritDoc
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @inheritDoc
     */
    public function packed(): string
    {
        return $this->packed ?? $this->packed = inet_pton($this->string);
    }

    /**
     * @inheritDoc
     */
    public function string(): string
    {
        return $this->string;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->string;
    }
}