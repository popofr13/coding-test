<?php

namespace Domain;

class Lot
{
    public function __construct(
        private readonly string $key,
        private bool $available = true
    )
    {
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