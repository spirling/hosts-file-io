<?php

namespace Spirling\HostsFileManager\Contract;

use InvalidArgumentException;
use RuntimeException;

/**
 * Interface IP
 * Abstraction over ip-address
 *
 * @package Spirling\HostsFileManager\Contract
 */
interface IP
{

    public const IPV4 = 4;
    public const IPV6 = 6;

    /**
     * Creates IP instance based on string representation
     *
     * @param string $string string representation of IP address
     * @return static instance of IP
     *
     * @throws InvalidArgumentException if string representation has invalid format
     */
    public static function fromString(string $string): static;

    /**
     * Creates IP instance based on packed ip-address
     *
     * @param string $packed packed ip-address
     * @return static instance of IP
     *
     * @throws InvalidArgumentException if packed data cannot be converted into ip-address
     * @throws RuntimeException if current PHP version doesn't support IPv6 addresses
     */
    public static function fromPacked(string $packed): static;

    /**
     * Returns version of IP protocol
     *
     * @return int version
     */
    public function getVersion(): int;

    /**
     * Returns packed representation of IP
     *
     * @return string packed representation of IP
     */
    public function packed(): string;

    /**
     * Returns string representation of ip
     *
     * @return string string representation of IP
     */
    public function string(): string;

    /**
     * Returns string representation of ip
     *
     * @return string string representation of IP
     */
    public function __toString(): string;

}