<?php

namespace TrafficLight;

class App
{
    /**
     * @param string          $lightColor
     * @param ConfigInterface $config
     */
    public static function start(string $lightColor, ConfigInterface $config)
    {
        echo sprintf('Starting traffic light app with color %s...', $lightColor) . PHP_EOL;

        $context = new TrafficLightContext($config, new TrafficLight($lightColor));

        while (true) {
            echo sprintf($context->getLight() . ' - %s', date('Y-m-d H:i:s', time())) . PHP_EOL;

            $seconds = $context->isDayMode() ? $config->get('printSecondsInDayMode')
                : ($context->isMorningMode() ? $config->get('printSecondsInMorningMode') : 1);

            sleep($seconds);
        }
    }
}