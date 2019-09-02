<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\Light\Green;
use TrafficLight\Light\LightStateInterface;
use TrafficLight\TrafficLight;
use TrafficLight\TrafficLightContext;

class TrafficLightTest extends TestCase
{
    public function testGetStartingLightColorReturnsCorrect()
    {
        $tl = new TrafficLight('red');
        $this->assertEquals('red', $tl->getStartingLightColor());
    }

    public function testGetLightReturnsLightStateInterface()
    {
        $trafficLight = new TrafficLight('red');

        $context = $this->getMockBuilder(TrafficLightContext::class)
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects($this->any())
            ->method('getLightState')
            ->willReturn(new Green(time() + 30));
        $context->expects($this->any())
            ->method('getEndTimeDependingOneMode')
            ->willReturn(time() + 30);

        $light = $trafficLight->getLight($context);
        $this->assertEquals(true, $light instanceof LightStateInterface);
    }
}