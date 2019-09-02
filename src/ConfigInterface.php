<?php


namespace TrafficLight;


interface ConfigInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);
}