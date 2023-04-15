<?php

namespace Domain;

use RuntimeException;

class LotRepository
{
    /**
     * @var Lot[]
     */
    private array $lots = [];

    public function __construct()
    {
        $this->lots[] = new Lot('A', true);
        $this->lots[] = new Lot('B', false);
        $this->lots[] = new Lot('C', true);
        $this->lots[] = new Lot('D', true);
        $this->lots[] = new Lot('E', false);
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