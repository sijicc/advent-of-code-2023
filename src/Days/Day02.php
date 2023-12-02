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

            $id = str_replace(
                'Game ',
                '',
                explode(':', $game)[0]
            );


            $values = explode('; ', explode(': ', $game)[1]);
            $values = array_map(function ($value) {
                $value = explode(', ', $value);
                return array_map(fn($v) => [
                    'color' => explode(' ', $v)[1],
                    'number' => explode(' ', $v)[0],
                ], $value);
            }, $values);

            foreach ($values as $value) {
                $red = array_sum(array_map(fn($v) => $v['color'] === 'red' ? $v['number'] : 0, $value));
                if ($red > 12) {
                    return 0;
                }
                $green = array_sum(array_map(fn($v) => $v['color'] === 'green' ? $v['number'] : 0, $value));
                if ($green > 13) {
                    return 0;
                }
                $blue = array_sum(array_map(fn($v) => $v['color'] === 'blue' ? $v['number'] : 0, $value));
                if ($blue > 14) {
                    return 0;
                }
            }

            return $id;
        }, $input);

        return array_sum($input);
    }

    public function part2(string $input)
    {
        $input = explode("\n", $input);
        $input = array_map(function ($game) {
            $game = trim($game);

            $id = str_replace(
                'Game ',
                '',
                explode(':', $game)[0]
            );


            $values = explode('; ', explode(': ', $game)[1]);
            $values = array_map(function ($value) {
                $value = explode(', ', $value);
                return array_map(fn($v) => [
                    'color' => explode(' ', $v)[1],
                    'number' => explode(' ', $v)[0],
                ], $value);
            }, $values);

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