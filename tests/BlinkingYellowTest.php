<?php


namespace TrafficLight\Light;


use PHPUnit\Framework\TestCase;
use TrafficLight\Config;
use TrafficLight\TrafficLight;
use TrafficLight\TrafficLightContext;

class BlinkingYellowTest extends TestCase
{
    public function testToString()
    {
        $this->assertEquals('yellow', new BlinkingYellow(time()));
    }

    public function testGetNextInstance()
    {
        $trafficLightContext = $this->getMockBuilder(TrafficLightContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLightContext->expects($this->any())
            ->method('getEndTimeDependingOneMode')
            ->willReturn(1);

        $actual = (new BlinkingYellow(time()))->getNext($trafficLightContext);

        $this->assertEquals(true, $actual instanceof BlinkingYellow);
    }
}