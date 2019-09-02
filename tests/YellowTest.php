<?php


namespace TrafficLight\Light;


use PHPUnit\Framework\TestCase;
use TrafficLight\TrafficLightContext;

class YellowTest extends TestCase
{
    public function testToString()
    {
        $this->assertEquals('yellow', new Yellow(time()));
    }

    public function testGetNextInstance()
    {
        $trafficLightContext = $this->getMockBuilder(TrafficLightContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLightContext->expects($this->any())
            ->method('getEndTimeDependingOneMode')
            ->willReturn(1);

        $actual = (new Yellow(time()))->getNext($trafficLightContext);

        $this->assertEquals(true, $actual instanceof Red);
    }
}