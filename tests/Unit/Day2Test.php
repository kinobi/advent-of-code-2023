<?php

use Kinobi\AdventOfCode2023\Day2;

it('can give the sum of possible games', function (string $filename, int $expected) {
    // 12 red cubes, 13 green cubes, and 14 blue cubes
    $resolver = new Day2($filename);

    $result = $resolver->resolvePartOne(red: 12, green: 13, blue: 14);

    expect($result)->toBe($expected);
})
    ->with([
        'test' => [storage('02_test1.txt'), 8],
        'puzzle' => [storage('02.txt'), 2164],
    ]);

it('can give the sum of the power of the minimum set of cubes', function (string $filename, int $expected) {
    // 12 red cubes, 13 green cubes, and 14 blue cubes
    $resolver = new Day2($filename);

    $result = $resolver->resolvePartTwo();

    expect($result)->toBe($expected);
})
    ->with([
        'test' => [storage('02_test1.txt'), 2286],
        'puzzle' => [storage('02.txt'), 69929],
    ]);
