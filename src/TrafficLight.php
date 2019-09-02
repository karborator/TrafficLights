<?php


namespace TrafficLight;

use TrafficLight\Light\LightStateInterface;

class TrafficLight implements TrafficLightInterface
{
    /**
     * @var string
     */
    private $startingLightColor;

    /**
     * TrafficLight constructor.
     *
     * @param string $startingLightColor
     */
    public function __construct(string $startingLightColor)
    {
        $this->startingLightColor = $startingLightColor;
    }

    /**
     * @return string
     */
    public function getStartingLightColor(): string
    {
        return $this->startingLightColor;
    }

    /**
     * @param TrafficLightContext $context
     *
     * @return LightStateInterface
     */
    public function getLight(TrafficLightContext $context): LightStateInterface
    {
        $lightState = $context->getLightState();

        if ($lightState->getEndTime() <= time()) {
            $context->setLightState($lightState->getNext($context));
        }

        return $lightState;
    }
}