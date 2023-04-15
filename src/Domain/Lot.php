<?php

namespace Domain;

class Lot
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var bool
     */
    private $available;

    /**
     * @param string $key
     * @param bool $available
     */
    public function __construct(string $key, bool $available)
    {
        $this->key = $key;
        $this->available = $available;
    }

    public function enable(): self {
        $this->available = true;
        return $this;
    }

    public function disable(): self {
        $this->available = false;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    public function isAvailable(): bool {
        return $this->available;
    }

}