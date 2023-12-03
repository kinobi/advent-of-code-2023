<?php

declare(strict_types=1);

namespace Kinobi\AdventOfCode2023;

class Day1
{
    use Helpers\Reader;

    public function __construct(public readonly string $inputFilename)
    {
    }

    public const array FIGURE_MAP = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
    ];

    public function partOne(): int
    {
        $reader = $this->readInput($this->inputFilename);

        $sum = 0;
        foreach ($reader as $line) {
            $sum += $this->getCalibrationValues($line);
        }

        return $sum;
    }


    public function partTwo(): int
    {
        $reader = $this->readInput($this->inputFilename);

        $sum = 0;
        foreach ($reader as $line) {
            $sum += $this->getCalibrationValuesWithLetters($line);
        }

        return $sum;
    }

    private function getCalibrationValues(string $line): int
    {
        $figures = (string)filter_var($line, FILTER_SANITIZE_NUMBER_INT);
        if (strlen($figures) === 1) {
            return (int)str_repeat($figures, 2);
        }

        if (strlen($figures) > 2) {
            return (int)(substr($figures, 0, 1) . substr($figures, -1));
        }

        return (int)$figures;
    }

    private function getCalibrationValuesWithLetters(string $line): int
    {
        $re = '/(?=([1-9]|one|two|three|four|five|six|seven|eight|nine))/';

        preg_match_all($re, $line, $matches, PREG_SET_ORDER, 0);

        $first = $matches[0][1];
        $second = $matches[count($matches) - 1][1];

        return (int)sprintf('%s%s', self::FIGURE_MAP[$first], self::FIGURE_MAP[$second]);
    }
}

// $input = fopen(__DIR__ . '/../storage/01.txt', 'r');



// $reader = function () use ($input) {
//     while (!feof($input)) {
//         yield fgets($input);
//     }
// };

// $filterPart1 = function (string $line): int {
//     $figures = (string)filter_var($line, FILTER_SANITIZE_NUMBER_INT);
//     if (strlen($figures) === 1) {
//         return (int)str_repeat($figures, 2);
//     }

//     if (strlen($figures) > 2) {
//         return (int)(substr($figures, 0, 1) . substr($figures, -1));
//     }

//     return (int)$figures;
// };

// $filterPart2 = function (string $line): int {
//     $re = '/(?=([1-9]|one|two|three|four|five|six|seven|eight|nine))/';

//     preg_match_all($re, $line, $matches, PREG_SET_ORDER, 0);

//     $first = $matches[0][1];
//     $second = $matches[count($matches) - 1][1];

//     return (int)sprintf('%s%s', FIGURE_MAP[$first], FIGURE_MAP[$second]);
// };

// $sum = 0;
// foreach ($reader() as $line) {
//     $sum += $filterPart2($line);
// }

// echo $sum . PHP_EOL;
