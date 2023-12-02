<?php

namespace Interfaces;

interface Day
{
    public function part1(string $input);

    public function part2(string $input);

    public function examplePart1(string $input): true;

    public function examplePart2(string $input): true;

    public function examplePart1Answer();

    public function examplePart2Answer();
}