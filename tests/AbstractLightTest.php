<?php


namespace TrafficLight\Light;

use PHPUnit\Framework\TestCase;
use TrafficLight\TrafficLightContext;

class AbstractLightTest extends TestCase
{
    public function testGetStartTime()
    {
        $this->assertNotNull((new class(time()) extends AbstractLight
        {
            public function getNext(TrafficLightContext $context): LightStateInterface
            {
            }

        })->getStartTime());
    }

    public function testGetEndTime()
    {
        $endTime = time();
        $this->assertEquals($endTime, (new class($endTime) extends AbstractLight
        {
            public function getNext(TrafficLightContext $context): LightStateInterface
            {
            }
        })->getEndTime());
    }
}