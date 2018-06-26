<?php

namespace Hector\Config;

class DotEnvLoader implements ConfigLoaderInterface
{
    /**
     * Array of filenames of .env files
     *
     * @var \string[]
     */
    private $filenames;

    /**
     * Array of extracted variables
     *
     * @var array
     */
    private $vars = [];

    /**
     * Stores if the loader has loaded
     *
     * @var bool
     */
    private $loaded = false;

    public function __construct(string ...$filenames)
    {
        $this->filenames = $filenames;
    }

    public function load()
    {
        if ($this->loaded) {
            return;
        }

        foreach ($this->filenames as $filename) {
            if (file_exists($filename)) {
                if (!is_readable($filename) || is_dir($filename)) {
                    throw new \Exception('Could not read file ' . $filename);
                }

                $this->extract($this->parse(file_get_contents($filename)));
            }
        }

        $this->loaded = true;
    }

    private function parse(string $contents) : array
    {
        $parsedVars = [];
        $contents = str_replace(["\n\r", "\r"], "\n", $contents);
        $lines = explode("\n", $contents);

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line) {
                $parts = explode('=', $line);
                $name = trim(array_shift($parts));
                $value = trim(implode('', $parts));
                $parsedVars[$name] = $value;
            }
        }

        return $parsedVars;
    }

    private function extract(array $vars)
    {
        foreach ($vars as $name => $value) {
            if (isset($this->vars[$name]) || isset($_ENV[$name])) {
                continue;
            }

            $this->vars[$name] = $value;
            putenv($name.'='.$value);
        }
    }

    public function set(string $name, $value)
    {
        $this->extract([$name => $value,]);
    }

    public function getVariables(): array
    {
        if (! $this->isLoaded()) {
            $this->load();
        }

        return $this->vars;
    }

    public function isLoaded(): bool
    {
        return $this->loaded;
    }
}
