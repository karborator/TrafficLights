<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\Light\Red;
use TrafficLight\Light\YellowGreen;
use TrafficLight\TrafficLightContext;

class YellowGreenTest extends TestCase
{
    public function testToString()
    {
        $this->assertEquals('green and yellow', new YellowGreen(time()));
    }

    public function testGetNextInstance()
    {
        $trafficLightContext = $this->getMockBuilder(TrafficLightContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLightContext->expects($this->any())
            ->method('getEndTimeDependingOneMode')
            ->willReturn(1);

        $actual = (new YellowGreen(time()))->getNext($trafficLightContext);

        $this->assertEquals(true, $actual instanceof Red);
    }
}