<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Repository;

use Domain\Lot;
use Domain\LotRepository;
use PHPUnit\Framework\TestCase;

class LotRepositoryTest extends TestCase
{
    public function testGetLots(): void
    {
        $lotRepository = new LotRepository([
            new Lot('A'),
            new Lot('B', available: false)
        ]);

        $lots = $lotRepository->getLots();

        $this->assertCount(2, $lots);
        $this->assertEquals('A', $lots[0]->getKey());
        $this->assertEquals('B', $lots[1]->getKey());
    }

    public function testGetLotByKey(): void
    {
        $lotRepository = new LotRepository([
            new Lot('A'),
            new Lot('B', available: false)
        ]);

        $lot = $lotRepository->getLotByKey('B');

        $this->assertEquals('B', $lot->getKey());
        $this->assertFalse($lot->isAvailable());

        $notExistingLot = $lotRepository->getLotByKey('Z');

        $this->assertNull($notExistingLot);
    }

    public function testRegisterLot(): void
    {
        $lotRepository = new LotRepository([
            new Lot('A'),
            new Lot('B', available: false)
        ]);

        $lotRepository->registerLot(new Lot('C'));

        $lots = $lotRepository->getLots();

        $this->assertCount(3, $lots);
        $this->assertEquals('C', $lots[2]->getKey());
    }
}