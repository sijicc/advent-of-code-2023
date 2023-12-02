<?php

namespace Traits;

trait DayTrait
{
    public string $paddedDay;

    public function __construct(
        public readonly int $day
    )
    {
        $this->paddedDay = str_pad($day, 2, '0', STR_PAD_LEFT);
    }

    public function run(): void
    {
        try {
            $this->printExample(1);
            print "Part 1: " . $this->part1($this->getInputFromFile()) . "\n";
            $this->printExample(2);
            print "Part 2: " . $this->part2($this->getInputFromFile()) . "\n";
        } catch (\Throwable $e) {
            print $e->getMessage();
        }
    }

    public function checkExamplePart1(): string
    {
        return $this->part1($this->getExamplePart1FromFile()) === $this->examplePart1Answer();
    }

    public function checkExamplePart2(): string
    {
        return $this->part2($this->getExamplePart2FromFile()) === $this->examplePart2Answer();
    }

    public function getInputFromFile(): string
    {
        return file_get_contents(
            __DIR__ . "/../../public/input/Day{$this->paddedDay}/input"
        );
    }

    public function getExamplePart1FromFile(): string
    {
        return file_get_contents(
            __DIR__ . "/../../public/input/Day{$this->paddedDay}/part1-example"
        );
    }

    public function getExamplePart2FromFile(): string
    {
        return file_get_contents(
            __DIR__ . "/../../public/input/Day{$this->paddedDay}/part2-example"
        );
    }

    public function printExample(int $part)
    {
        if($part === 1) {
            $expected = $this->examplePart1Answer();
            $actual = $this->part1($this->getExamplePart1FromFile());
        } elseif($part === 2) {
            $expected = $this->examplePart2Answer();
            $actual = $this->part2($this->getExamplePart2FromFile());
        } else {
            throw new \Exception('Invalid part');
        }

        $isCorrect = $expected === $actual ? '✅' : '❌';

        print "Example part {$part}: {$isCorrect}  answer: {$actual} expected: {$expected}\n";
    }
}