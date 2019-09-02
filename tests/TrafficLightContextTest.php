<?php

use PHPUnit\Framework\TestCase;
use TrafficLight\Light\Green;
use TrafficLight\Light\LightStateInterface;
use TrafficLight\TrafficLight;
use TrafficLight\TrafficLightContext;
use TrafficLight\Config;

class TrafficLightContextTest extends TestCase
{
    public function testGetLightReturnsLightStateInterface()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(true);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLight->expects($this->any())
            ->method('getStartingLightColor')
            ->willReturn('green');
        $trafficLight->expects($this->any())
            ->method('getLight')
            ->willReturn(new Green(time()));

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(true, $trafficLightContext->getLight() instanceof Green);
    }

    public function testGetLightStateReturnsLightStateInterface()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(true);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLight->expects($this->any())
            ->method('getStartingLightColor')
            ->willReturn('green');
        $trafficLight->expects($this->any())
            ->method('getLight')
            ->willReturn(new Green(time()));

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(true, $trafficLightContext->getLightState() instanceof  LightStateInterface);
    }


    public function testSetLightStateReturnsLightStateInterface()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(true);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();
        $trafficLight->expects($this->any())
            ->method('getStartingLightColor')
            ->willReturn('green');
        $trafficLight->expects($this->any())
            ->method('getLight')
            ->willReturn(new Green(time()));

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(true, $trafficLightContext->setLightState(new Green(time())) instanceof  TrafficLightContext);
    }

    public function testGetEndTimeDependingOneMode()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(1);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(1, $trafficLightContext->getEndTimeDependingOneMode('green'));
    }

    public function testIsDayMode()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(1);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(true, $trafficLightContext->isDayMode());
    }


    public function testIsMorningMode()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        $config->expects($this->any())
            ->method('get')
            ->willReturn(1);

        $trafficLight =  $this->getMockBuilder(TrafficLight::class)
            ->disableOriginalConstructor()
            ->getMock();

        $trafficLightContext  = new TrafficLightContext($config, $trafficLight);
        $this->assertEquals(true, $trafficLightContext->isMorningMode());
    }
}