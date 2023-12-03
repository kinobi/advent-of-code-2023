<?php

use Kinobi\AdventOfCode2023\Day1;

it('can give the sum of all calibration values', function (string $filename, int $expected) {
    $resolver = new Day1($filename);

    $sum = $resolver->partOne();

    expect($sum)->toBe($expected);
})
    ->with([
        'test' => [storage('01_test1.txt'), 142],
        'puzzle' => [storage('01.txt'), 55130],
    ]);


it('can give the sum of all calibration values with letters', function (string $filename, int $expected) {
    $resolver = new Day1($filename);

    $sum = $resolver->partTwo();

    expect($sum)->toBe($expected);
})
    ->with([
        'test' => [storage('01_test2.txt'), 281],
        'puzzle' => [storage('01.txt'), 54985],
    ]);
