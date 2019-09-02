<?php


namespace TrafficLight\Light;


use PHPUnit\Framework\TestCase;
use TrafficLight\TrafficLightContext;

class RedTest extends TestCase
{
    public function testToString()
    {
        $this->assertEquals('red', new Red(time()));
    }

    public function testGetNextInstance()
    {
        $trafficLightContext = $this->getMockBuilder(TrafficLightContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLightContext->expects($this->any())
            ->method('getEndTimeDependingOneMode')
            ->willReturn(1);

        $actual = (new Red(time()))->getNext($trafficLightContext);

        $this->assertEquals(true, $actual instanceof Green);
    }
}