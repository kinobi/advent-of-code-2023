<?php

declare(strict_types=1);

namespace Kinobi\AdventOfCode2023;

use Kinobi\AdventOfCode2023\Helpers\Reader;

class Day3
{
    use Reader;

    public function __construct(public readonly string $inputFilename)
    {
    }

    public function partOne(): int
    {
        $matrix = $this->createMatrix();
        $sum = 0;
        $matrixRowCnt = count($matrix);
        $matrixColCount = count($matrix[0]);
        $cursorX = 0;
        $cursorY = 0;

        while ($cursorX <= $matrixRowCnt) {
            $cursorY = 0;
            $currentNumber = '';
            $hasSymbolNearby = 0b0;
            while ($cursorY <= $matrixColCount) {
                $cell = $matrix[$cursorX][$cursorY] ?? null;

                if (!$cell || !$cell['isDigit']) {
                    if ($hasSymbolNearby) {
                        $sum += (int)$currentNumber;
                    }

                    $currentNumber = '';
                    $hasSymbolNearby = 0b0;
                } else {
                    $currentNumber .= $cell['value'];
                    $hasSymbolNearby |= (int)$this->hasSymbolNearby($matrix, $cursorX, $cursorY);
                }

                $cursorY++;
            }

            $cursorX++;
        }

        return $sum;
    }

    public function partTwo(): int
    {
        $matrix = $this->createMatrix();
        $matrixRowCnt = count($matrix);
        $matrixColCount = count($matrix[0]);
        $cursorX = 0;
        $cursorY = 0;
        $gears = [];


        for ($cursorX = 0; $cursorX <= $matrixRowCnt; $cursorX++) {
            $currentNumber = '';
            $adjacentGears = [];
            for ($cursorY = 0; $cursorY <= $matrixColCount; $cursorY++) {
                $cell = $matrix[$cursorX][$cursorY] ?? null;

                if (!$cell || !$cell['isDigit']) {
                    foreach (array_unique($adjacentGears) as $adjacentGearKey) {
                        $gears[$adjacentGearKey][] = (int)$currentNumber;
                    }

                    $currentNumber = '';
                    $adjacentGears = [];
                } else {
                    $currentNumber .= $cell['value'];
                    $adjacentGears = array_merge($adjacentGears, $this->findAdjacentGears($matrix, $cursorX, $cursorY));
                }
            }
        }

        $gears = array_filter($gears, fn ($gear) => count($gear) === 2);


        return (int)array_reduce($gears, fn ($carry, $gear) => $carry + $gear[0] * $gear[1]);
    }

    private function hasSymbolNearby(array $matrix, int $cursorX, int $cursorY): bool
    {
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                $cell = $matrix[$i + $cursorX][$j + $cursorY] ?? null;
                if (!$cell || ($i === 0 && $j === 0)) {
                    continue;
                }

                if ($cell['isSymbol']) {
                    return true;
                }
            }
        }

        return false;
    }

    private function findAdjacentGears(array $matrix, int $cursorX, int $cursorY): array
    {
        $found = [];

        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                $x = $i + $cursorX;
                $y = $j + $cursorY;

                $cell = $matrix[$x][$y] ?? null;
                if (!$cell || ($i === 0 && $j === 0)) {
                    continue;
                }

                if ($cell['isSymbol'] && $cell['value'] === '*') {
                    $found[] = sprintf('%s;%s', $x, $y);
                }
            }
        }

        return $found;
    }

    private function createMatrix(): array
    {
        $matrix = [];
        $rowIdx = 0;

        $reader = $this->readInput($this->inputFilename);
        foreach ($reader as $input) {
            $row = str_split(trim($input));
            foreach ($row as $colIdx => $cell) {
                $isDigit = is_numeric($cell);
                $isSymbol = $isDigit ? false : $cell !== '.';

                $matrix[$rowIdx][$colIdx] = [
                    'value' => $cell,
                    'isDigit' => $isDigit,
                    'isSymbol' => $isSymbol,
                ];
            }

            $rowIdx++;
        }

        return $matrix;
    }
}
