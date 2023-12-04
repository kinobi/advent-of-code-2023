<?php

declare(strict_types=1);

namespace Kinobi\AdventOfCode2023;

use Kinobi\AdventOfCode2023\Helpers\Reader;

class Day4
{
    use Reader;

    public function __construct(public readonly string $inputFilename)
    {
    }

    public function partOne(): int
    {
        $total = 0;
        $reader = $this->readInput($this->inputFilename);

        foreach ($reader as $card) {
            $re = '/Card\s+(\d+): ([(\d+)\s+]+)\| ([(\d+)\s+]+)/';

            preg_match($re, $card, $matches);
            $gameId = $matches[1];
            $winningNumbers = preg_split('/\s+/', trim($matches['2']));
            $playedNumbers = preg_split('/\s+/', trim($matches['3']));

            $wins = array_intersect($winningNumbers, $playedNumbers);
            $winCount = count($wins);

            if ($winCount <= 2) {
                $total += $winCount;
                continue;
            }

            $total += 2 ** ($winCount - 1);
        }

        return $total;
    }

    public function partTwo(): int
    {
        $scratchcards = [];
        $reader = $this->readInput($this->inputFilename);

        foreach ($reader as $card) {
            $re = '/Card\s+(\d+): ([(\d+)\s+]+)\| ([(\d+)\s+]+)/';

            preg_match($re, $card, $matches);
            $gameId = (int)$matches[1];
            $winningNumbers = preg_split('/\s+/', trim($matches['2']));
            $playedNumbers = preg_split('/\s+/', trim($matches['3']));

            $wins = array_intersect($winningNumbers, $playedNumbers);
            $winCount = count($wins);

            // Add current scratchcard
            isset($scratchcards[$gameId]) ?: $scratchcards[$gameId] = 0;
            $scratchcards[$gameId]++;

            if ($winCount === 0) {
                continue;
            }

            // Add won scratchcard copies
            for ($i = 1; $i <= $winCount; $i++) {
                isset($scratchcards[$gameId + $i]) ?: $scratchcards[$gameId + $i] = 0;
                $scratchcards[$gameId + $i] += $scratchcards[$gameId];
            }
        }

        return array_sum($scratchcards);
    }
}
