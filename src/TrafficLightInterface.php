<?php

namespace TrafficLight;

use TrafficLight\Light\LightStateInterface;

interface TrafficLightInterface
{
    /**
     * @param TrafficLightContext $context
     *
     * @return LightStateInterface
     */
    public function getLight(TrafficLightContext $context): LightStateInterface;

    /**
     * @return string
     */
    public function getStartingLightColor(): string;
}