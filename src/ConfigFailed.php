<?php


namespace TrafficLight;


class ConfigFailed extends \RuntimeException
{
    const BAD_DIRECTORY = 'Config error: bad directory given';

    /**
     * @return ConfigFailed
     */
    public static function badDirectory()
    {
        return new static(static::BAD_DIRECTORY);
    }
}