<?php


namespace TrafficLight\Light;


use TrafficLight\TrafficLightContext;

interface LightStateInterface
{
    /**
     * @return mixed
     */
    public function __toString();

    /**
     * @return int
     */
    public function getStartTime(): int;

    /**
     * @return int
     */
    public function getEndTime(): int;

    /**
     * @param TrafficLightContext $context
     *
     * @return LightStateInterface
     */
    public function getNext(TrafficLightContext $context): LightStateInterface;
}