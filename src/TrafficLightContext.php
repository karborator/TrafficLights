<?php

namespace TrafficLight;

use TrafficLight\Light\BlinkingYellow;
use TrafficLight\Light\LightStateInterface;
use TrafficLight\Light\Yellow;

class TrafficLightContext
{
    const DAY_MODE = 'Day';
    const MORNING_MODE = 'Morning';
    const INTERVAL_TEMPLATE = '%sIntervalIn%sMode';

    /**
     * @var LightStateInterface
     */
    private $lightState;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var string
     */
    private $dayModeStart;

    /**
     * @var string
     */
    private $dayModeEnd;

    /**
     * @var string
     */
    private $morningModeStart;

    /**
     * @var string
     */
    private $morningModeEnd;

    /**
     * @var TrafficLightInterface
     */
    private $trafficLight;

    /**
     * TrafficLightContext constructor.
     *
     * @param ConfigInterface       $config
     * @param TrafficLightInterface $trafficLight
     */
    public function __construct(ConfigInterface $config, TrafficLightInterface $trafficLight)
    {
        $this->config = $config;
        $this->trafficLight = $trafficLight;
        $this->dayModeStart = $this->config->get('dayModeStart');
        $this->dayModeEnd = $this->config->get('dayModeEnd');
        $this->morningModeStart = $this->config->get('morningModeStart');
        $this->morningModeEnd = $this->config->get('morningModeEnd');

        $this->lightState = $this->createLightState($trafficLight->getStartingLightColor());
    }

    /**
     * @return LightStateInterface
     */
    public function getLight(): LightStateInterface
    {
        return $this->trafficLight->getLight($this);
    }

    /**
     * @return LightStateInterface
     */
    public function getLightState(): LightStateInterface
    {
        return $this->lightState;
    }

    /**
     * @param LightStateInterface $lightState
     *
     * @return TrafficLightContext
     */
    public function setLightState(LightStateInterface $lightState): self
    {
        $this->lightState = $lightState;
        return $this;
    }

    /**
     * @param string $lightColor
     *
     * @return int
     */
    public function getEndTimeDependingOneMode(string $lightColor): int
    {
        $mode = $this->isDayMode() ? self::DAY_MODE : ($this->isMorningMode() ? self::MORNING_MODE : '');

        return $this->config->get(sprintf(self::INTERVAL_TEMPLATE, $lightColor, $mode));
    }


    /**
     * @return bool
     */
    public function isDayMode(): bool
    {
        if (null !== $this->config->get('isDayMode')) {
            return (bool)$this->config->get('isDayMode');
        }

        $start = strtotime($this->dayModeStart);
        $end = strtotime($this->dayModeEnd);

        return time() >= $start && time() <= $end;
    }

    /**
     * @return bool
     */
    public function isMorningMode(): bool
    {
        if (null !== $this->config->get('isMorningMode')) {
            return $this->config->get('isMorningMode');
        }

        $start = strtotime($this->morningModeStart);
        $end = strtotime($this->morningModeEnd);

        return time() >= $start && time() <= $end;
    }

    /**
     * @param string $lightColor
     *
     * @return mixed
     */
    private function createLightState(string $lightColor): LightStateInterface
    {
        $lightClass = sprintf('TrafficLight\\Light\\%s', ucfirst($lightColor));

        if ($this->isMorningMode()) {
            $lightClass = BlinkingYellow::class;
            $lightColor = Yellow::LIGHT;
        }

        if (!class_exists($lightClass)) {
            throw new \RuntimeException(sprintf('Unsupported light color "%s"', $lightColor), 500);
        }

        return new $lightClass(time() + $this->getEndTimeDependingOneMode($lightColor));
    }
}