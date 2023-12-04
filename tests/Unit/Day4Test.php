<?php

use Kinobi\AdventOfCode2023\Day4;

it('can give the total of winning point', function (string $filename, int $expected) {
    $day4 = new Day4($filename);

    $total = $day4->partOne();

    expect($total)->toBe($expected);
})
    ->with([
        'Example' => [storage('04_test1.txt'), 13],
        'Solution' => [storage('04.txt'), 22674],
    ]);

it('can give the total of won scratchcard', function (string $filename, int $expected) {
    $day4 = new Day4($filename);

    $total = $day4->partTwo();

    expect($total)->toBe($expected);
})
    ->with([
        'Example' => [storage('04_test1.txt'), 30],
        'Solution' => [storage('04.txt'), 5747443],
    ]);
