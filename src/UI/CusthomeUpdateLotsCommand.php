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

    /**
     * @var LotRepository
     */
    private $lotRepository;

    /**
     * @param LotRepository $lotRepository
     */
    public function __construct(LotRepository $lotRepository)
    {
        $this->lotRepository = $lotRepository;
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

        /**
         * You code here
         */

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
