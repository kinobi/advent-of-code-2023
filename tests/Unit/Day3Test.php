<?php

use Kinobi\AdventOfCode2023\Day3;

it('can add all part numbers', function (string $filename, int $expected) {
    $day3 = new Day3($filename);

    $sum = $day3->partOne();

    expect($sum)->toBe($expected);
})
    ->with([
        'test' => [storage('03_test1.txt'), 4361],
        'puzzle' => [storage('03.txt'), 529618],
    ]);

it('can add all gear ratios', function (string $filename, int $expected) {
    $day3 = new Day3($filename);

    $sum = $day3->partTwo();

    expect($sum)->toBe($expected);
})
    ->with([
        'test' => [storage('03_test1.txt'), 467835],
        'puzzle' => [storage('03.txt'), 77509019],
    ]);
