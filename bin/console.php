<?php

use TrafficLight\Config;
use TrafficLight\Light\Green;

require_once './vendor/autoload.php';

$lightColor = next($argv);
if (!$lightColor) {
    $lightColor = Green::LIGHT;
}

try {
    TrafficLight\App::start($lightColor, Config::getInstance());
} catch (\RuntimeException $e) {
    echo $e->getMessage() . PHP_EOL;
}

