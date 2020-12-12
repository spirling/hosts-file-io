<?php

namespace Spirling\HostsFileManager\Tests;

use PHPUnit\Framework\TestCase;
use Spirling\HostsFileManager\IP;

class IPTest extends TestCase
{

    public function validIpStringDataProvider()
    {
        return [
            ['127.0.0.1'],
            ['8.8.8.8'],
        ];
    }

    /**
     * @param $ip
     * @dataProvider validIpStringDataProvider
     */
    public function testValidIpFromString($ip)
    {
        $instance = IP::fromString($ip);
        $this->assertEquals($ip, $instance->string());
    }

}