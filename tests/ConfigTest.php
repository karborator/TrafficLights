<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\Config;

class ConfigTest extends TestCase
{
    public function testGetInstance()
    {
        $this->assertEquals(true, Config::getInstance() instanceof Config);
    }

    public function testGet()
    {
        $this->assertEquals(true, Config::getInstance('./')->get('test'));
    }
}