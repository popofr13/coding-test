<?php

namespace UI;

use Domain\Lot;
use Domain\LotRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CusthomeUpdateLotsCommand extends Command
{
    protected static $defaultName = 'custhome:update:lots';

    public function __construct(
        private readonly LotRepository $lotRepository
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Update lots from a remote stream')->addArgument(
            'path',
            InputArgument::REQUIRED,
            'Path to the remote stream'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $importedLots = json_decode(file_get_contents($path), true);

        foreach ($importedLots as $importedLot) {
            $lot = $this->lotRepository->getLotByKey($importedLot['key']);
            if (null === $lot) {
                $lot = new Lot($importedLot['key']);

                $this->lotRepository->registerLot($lot);

                continue;
            }

            if (false === $lot->isAvailable()) {
                $lot->enable();
            }
        }

        // Disable all lots that are not in the remote stream
        $importedLotKeys = array_column($importedLots, 'key');
        foreach ($this->lotRepository->getLots() as $lot) {
            if(false === in_array($lot->getKey(), $importedLotKeys)) {
                $lot->disable();
            }
        }

        if ($this->checkResult($this->lotRepository->getLots()))
        {
            $output->writeln('Success');
        }
        else {
            $output->writeln('Failed');
        }
        return 0;
    }


    /**
     * @param Lot[] $lots
     * @return bool
     */
    private function checkResult(array $lots): bool
    {
        return $lots == [
                new Lot('A', true),
                new Lot('B', true),
                new Lot('C', true),
                new Lot('D', false),
                new Lot('E', false),
                new Lot('F', true),
            ];
    }

}
