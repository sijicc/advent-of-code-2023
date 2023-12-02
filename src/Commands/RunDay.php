<?php

namespace Commands;

use Interfaces\Day;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traits\DayTrait;

#[AsCommand(
    name: 'app:run-day',
    description: 'Run advent of code day',
)]
final class RunDay extends Command
{
    private string $paddedDay;
    private int $day;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->day = (int)$input->getArgument('day');

        $this->paddedDay = str_pad($this->day, 2, '0', STR_PAD_LEFT);

        $dayClass = "Days\Day{$this->paddedDay}";

        /**
         * @var Day $day
         * @var DayTrait $day
         */
        $day = new $dayClass($this->day);

        $day->run();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument(
            'day',
            InputArgument::REQUIRED,
            'The day to run'
        );

    }
}