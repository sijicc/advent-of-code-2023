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
        print "Example part 1: " . $this->checkExamplePart1(). "\n";
        print "Example part 2: " . $this->checkExamplePart2(). "\n";
        print "Part 1: " . $this->part1($this->getInputFromFile()). "\n";
        print "Part 2: " . $this->part2($this->getInputFromFile()). "\n";
    }

    public function checkExamplePart1(): string
    {
        return $this->examplePart1($this->getExamplePart1FromFile()) === $this->examplePart1Answer();
    }

    public function checkExamplePart2(): string
    {
        return $this->examplePart2($this->getExamplePart2FromFile()) === $this->examplePart2Answer();
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
}