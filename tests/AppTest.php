<?php


use PHPUnit\Framework\TestCase;
use TrafficLight\App;
use TrafficLight\Config;

class AppTest extends TestCase
{
    public function testStart()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(1);

        try {
            App::start('green', $config, true);
        } catch (\Throwable $e) {
            $this->fail();
        }

        $this->assertTrue(true);
    }
}