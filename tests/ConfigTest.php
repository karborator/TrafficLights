<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\Config;

class ConfigTest extends TestCase
{
    const TEST_CONFIG_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'config';

    public function testGetInstance()
    {
        $this->assertEquals(true, Config::getInstance(self::TEST_CONFIG_DIR) instanceof Config);
    }

    public function testGet()
    {
        $this->assertEquals(true, Config::getInstance(self::TEST_CONFIG_DIR)->get('test'));
    }
}