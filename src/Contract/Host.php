<?php

namespace Spirling\HostsFileManager\Contract;

interface Host
{

    public function getName(): string;

    public function getIp(): string;

    public function getVersion(): string;

    public function withIp(string $ip, int $version = IP::IPV4): static;

    public function __toString(): string;

}