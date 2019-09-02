<?php


namespace TrafficLight;


class Config implements ConfigInterface
{
    const CONFIG_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config';

    private static $instance;
    private $confDir;
    private $config = [];

    /**
     * Config constructor.
     *
     * @param string $confDir
     */
    private function __construct(string $confDir)
    {
        $this->confDir = realpath($confDir);
        if (!is_readable($this->confDir) || !is_dir($this->confDir)) {
            throw ConfigFailed::badDirectory();
        }

        $processed = $this->parseConfig();
        if ($processed && is_array($processed)) {
            $this->config = array_merge($this->config, $processed);
        }
    }

    /**
     * @param string|null $confDir
     * @return ConfigInterface
     */
    public static function getInstance(string $confDir = null): ConfigInterface
    {
        return self::$instance ?? self::$instance = new static($confDir ?? self::CONFIG_DIR);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * @return array|bool
     */
    private function parseConfig()
    {
        $files = scandir($this->confDir);
        foreach ($files as $file) {
            if (!is_file($this->confDir . DIRECTORY_SEPARATOR . $file)) {
                continue;
            }

            return parse_ini_file($this->confDir . DIRECTORY_SEPARATOR . $file);
        }
    }
}