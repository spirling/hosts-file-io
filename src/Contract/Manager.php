<?php


namespace Spirling\HostsFileManager\Contract;


interface Manager
{

    public function add(string $hostName, string $ip, string $version = Host::IPV4): bool;

    public function has(string $hostName): bool;

    public function get(string $hostName): Host;

}