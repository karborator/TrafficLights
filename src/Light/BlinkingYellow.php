<?php


namespace TrafficLight\Light;


use TrafficLight\TrafficLightContext;

class BlinkingYellow extends Yellow
{
    public function getNext(TrafficLightContext $context): LightStateInterface
    {
        return new BlinkingYellow(time() + $context->getEndTimeDependingOneMode(Yellow::LIGHT));
    }
}