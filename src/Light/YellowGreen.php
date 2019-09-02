<?php


namespace TrafficLight\Light;

class YellowGreen extends Yellow
{
    public function __toString()
    {
        return Green::LIGHT . ' and ' . self::LIGHT;
    }
}