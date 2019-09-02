<?php


namespace TrafficLight\Light;


use TrafficLight\TrafficLightContext;

class Green extends AbstractLight
{
    const LIGHT = 'green';

    public function getNext(TrafficLightContext $context): LightStateInterface
    {
        $lightColor = strtolower(Yellow::LIGHT) . ucfirst(Green::LIGHT);
        return new YellowGreen(time() + $context->getEndTimeDependingOneMode($lightColor));
    }

}