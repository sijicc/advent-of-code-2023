<?php

namespace Days;

use Interfaces\Day;
use Traits\DayTrait;

class Day02 implements Day
{
    use DayTrait;

    public function part1(string $input)
    {
        $input = explode("\n", $input);
        $input = array_map(function ($game) {
            $game = trim($game);

            $values = array_map(function ($value) {
                $value = explode(', ', $value);
                return array_map(fn($v) => [
                    'color' => explode(' ', $v)[1],
                    'number' => explode(' ', $v)[0],
                ], $value);
            }, explode('; ', explode(': ', $game)[1]));

            foreach ($values as $value) {
                if (12 < array_sum(array_map(fn($v) => $v['color'] === 'red' ? $v['number'] : 0, $value))) {
                    return 0;
                } elseif (13 < array_sum(array_map(fn($v) => $v['color'] === 'green' ? $v['number'] : 0, $value))) {
                    return 0;
                } elseif (14 < array_sum(array_map(fn($v) => $v['color'] === 'blue' ? $v['number'] : 0, $value))) {
                    return 0;
                }
            }

            return str_replace(
                'Game ',
                '',
                explode(':', $game)[0]
            );
        }, $input);

        return array_sum($input);
    }

    public function part2(string $input)
    {
        $input = explode("\n", $input);
        $input = array_map(function ($game) {
            $game = trim($game);
            $values = array_map(function ($value) {
                $value = explode(', ', $value);
                return array_map(fn($v) => [
                    'color' => explode(' ', $v)[1],
                    'number' => explode(' ', $v)[0],
                ], $value);
            }, explode('; ', explode(': ', $game)[1]));

            $red = [];
            $green = [];
            $blue = [];
            foreach ($values as $value) {
                $red[] = array_sum(array_map(fn($v) => $v['color'] === 'red' ? $v['number'] : 0, $value));
                $green[] = array_sum(array_map(fn($v) => $v['color'] === 'green' ? $v['number'] : 0, $value));
                $blue[] = array_sum(array_map(fn($v) => $v['color'] === 'blue' ? $v['number'] : 0, $value));
            }

            return max($red) * max($green) * max($blue);
        }, $input);

        return array_sum($input);
    }

    public function examplePart1Answer(): int
    {
        return 8;
    }

    public function examplePart2Answer(): int
    {
        return 2286;
    }
}