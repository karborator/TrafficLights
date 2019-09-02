<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\ConfigFailed;

class ConfigFailedTest extends TestCase
{
    public function testBadDirectoryMessage()
    {
        $this->assertEquals(ConfigFailed::BAD_DIRECTORY, ConfigFailed::badDirectory()->getMessage());
    }
}