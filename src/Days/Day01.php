<?php

namespace Days;

use Interfaces\Day;
use Traits\DayTrait;

class Day01 implements Day
{
    use DayTrait;

    public function part1(string $input)
    {
        $input = explode("\n", $input);
        $input = array_map(function (string $line) {
            $line = trim($line);

            preg_match_all('/\d/', $line, $numbers);
            $numbers = $numbers[0];

            return count($numbers) >= 1
                ? (int)($numbers[0] . $numbers[count($numbers) - 1])
                : 0;
        }, $input);

        return array_sum($input);
    }

    public function part2(string $input)
    {
        $input = explode("\n", $input);
        $input = array_map(function (string $line) {
            $line = trim($line);

            preg_match_all('/(?=(one|two|three|four|five|six|seven|eight|nine|\d))/', $line, $numbers);

            $numbers = array_map(fn($number) => str_replace(
                ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
                [1, 2, 3, 4, 5, 6, 7, 8, 9],
                $number
            ), $numbers[1]);

            return count($numbers) >= 1
                ? (int)($numbers[0] . $numbers[count($numbers) - 1])
                : 0;
        }, $input);

        return array_sum($input);
    }

    public function examplePart1Answer(): int
    {
        return 142;
    }

    public function examplePart2Answer(): int
    {
        return 281;
    }
}