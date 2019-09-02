<?php


namespace TrafficLight\Light;


use TrafficLight\TrafficLightContext;

class Red extends AbstractLight
{
    const LIGHT = 'red';

    public function getNext(TrafficLightContext $context): LightStateInterface
    {
        return new Green(time() + $context->getEndTimeDependingOneMode(Green::LIGHT));
    }

}