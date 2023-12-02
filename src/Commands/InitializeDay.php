<?php

namespace Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:initialize-day',
    description: 'Initialize a new advent of code day',
    aliases: ['app:init-day'],
)]
final class InitializeDay extends Command
{
    private string $paddedDay;
    private int $day;

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->day = (int)$input->getArgument('day');

        $this->paddedDay = str_pad($this->day, 2, '0', STR_PAD_LEFT);

        $this->prepareInputFiles();
        $this->prepareSolutionFiles();

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument(
            'day',
            InputArgument::REQUIRED,
            'The day to initialize'
        );

    }

    private function prepareInputFiles(): void
    {
        if (!is_dir(__DIR__ . '/../../public/input')) {
            mkdir(__DIR__ . '/../../public/input');
        }

        if (!is_dir($this->getInputDirectoryPath())) {
            mkdir($this->getInputDirectoryPath());
        }

        $inputPath = $this->getInputDirectoryPath() . '/input';
        if (!file_exists($inputPath)) {
            file_put_contents($inputPath, $this->getInputData());
        }

        $firstExamplePath = $this->getInputDirectoryPath() . '/part1-example';
        if (!file_exists($firstExamplePath)) {
            file_put_contents($firstExamplePath, '');
        }

        $secondExamplePath = $this->getInputDirectoryPath() . '/part2-example';
        if (!file_exists($secondExamplePath)) {
            file_put_contents($secondExamplePath, '');
        }

        // TODO: Try to parse text for examples
    }

    private function getInputDirectoryPath(): string
    {
        return __DIR__ . "/../../public/input/Day{$this->paddedDay}";
    }

    private function getSolutionDirectoryPath(): string
    {
        return __DIR__ . "/../Days";
    }

    private function prepareSolutionFiles(): void
    {
        if (!is_dir(__DIR__ . '/../Days')) {
            mkdir(__DIR__ . '/../Days');
        }

        if (!is_dir($this->getSolutionDirectoryPath())) {
            mkdir($this->getSolutionDirectoryPath());
        }

        $dayPath = $this->getSolutionDirectoryPath() . "/Day{$this->paddedDay}.php";
        if (!file_exists($dayPath)) {
            file_put_contents($dayPath, $this->getDayStub());
        }
    }

    private function getDayStub(): string
    {
        $stub = file_get_contents(__DIR__ . '/../stubs/DayStub.php.stub');

        $stub = str_replace('{PADDED_DAY}', $this->paddedDay, $stub);

        return $stub;
    }

    private function getInputData(): string
    {
        return '';

//         TODO: Get input data from advent of code
//        $url = "https://adventofcode.com/2020/day/{$this->day}/input";
//
//
//        return file_get_contents($url) ?: '';
    }
}