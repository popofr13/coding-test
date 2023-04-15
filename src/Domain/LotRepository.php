<?php

namespace Domain;

class LotRepository
{
    /**
     * @var Lot[]
     */
    private $lots = [];

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

    /**
     * @param string $key
     * @return Lot
     * @Throw \RuntimeException
     */
    public function getLotByKey(string $key): Lot
    {
        /**
         * You code here
         */
    }

    public function registerLot(Lot $lot)
    {
        /**
         * You code here
         */
    }

}