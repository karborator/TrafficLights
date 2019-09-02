<?php


namespace TrafficLight\Light;


use TrafficLight\TrafficLightContext;

class Yellow extends AbstractLight
{
    const LIGHT = 'yellow';

    public function getNext(TrafficLightContext $context): LightStateInterface
    {
        return new Red(time() + $context->getEndTimeDependingOneMode(Red::LIGHT));
    }

}