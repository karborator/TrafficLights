<?php


namespace TrafficLight\Light;


abstract class AbstractLight implements LightStateInterface
{
    const LIGHT = null;

    /**
     * @var int
     */
    private $startTime;

    /**
     * @var int
     */
    private $endTime;

    /**
     * AbstractLight constructor.
     *
     * @param int $endTime
     */
    public function __construct(int $endTime)
    {
        $this->startTime = time();
        $this->endTime = $endTime;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return static::LIGHT ?? '';
    }

    /**
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }
}