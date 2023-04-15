<?php

namespace Domain;

use RuntimeException;

class LotRepository
{
    /**
     * @var $lots array|Lot[]
     */
    public function __construct(
        private array $lots = []
    )
    {
    }

    /**
     * @return Lot[]
     */
    public function getLots(): array
    {
        return $this->lots;
    }

    public function getLotByKey(string $key): ?Lot
    {
        $lots = array_filter($this->lots, function (Lot $lot) use ($key) {
            return $lot->getKey() === $key;
        });

        if (0 === count($lots)) {
            return null;
        }

        return current($lots);
    }

    /**
     * @param Lot $lot
     * @return void
     * @throws RuntimeException
     */
    public function registerLot(Lot $lot): void
    {
        $existingLot = $this->getLotByKey($lot->getKey());
        if (null !== $existingLot) {
            throw new RuntimeException('Lot already exists');
        }

        $this->lots[] = $lot;
    }

}