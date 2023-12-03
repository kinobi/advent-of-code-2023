<?php

declare(strict_types=1);

namespace Kinobi\AdventOfCode2023;

class Day2
{
    use Helpers\Reader;

    public function __construct(public readonly string $inputFilename)
    {
    }

    public function resolvePartOne(int $red, int $green, int $blue): int
    {
        $reader = $this->readInput($this->inputFilename);

        $games = [];
        $gamesWrong = [];

        foreach ($reader as $line) {
            // Extract Cubes for a Game
            [$gameId, $cubes] = $this->parseGame($line);
            $games[] = $gameId;

            // Check below bag
            foreach ($cubes as $hand) {
                if ($hand['color'] === 'red' && $hand['count'] > $red) {
                    $gamesWrong[] = $gameId;
                }

                if ($hand['color'] === 'green' && $hand['count'] > $green) {
                    $gamesWrong[] = $gameId;
                }

                if ($hand['color'] === 'blue' && $hand['count'] > $blue) {
                    $gamesWrong[] = $gameId;
                }
            }
        }

        return array_sum(array_diff($games, $gamesWrong));
    }

    public function resolvePartTwo(): int
    {
        $reader = $this->readInput($this->inputFilename);

        $powers = [];

        foreach ($reader as $line) {
            // Extract Cubes for a Game
            [$gameId, $cubes] = $this->parseGame($line);

            $minColors = [
                'red' => null,
                'green' => null,
                'blue' => null,
            ];

            foreach ($cubes as $cube) {
                if($minColors[$cube['color']] === null) {
                    $minColors[$cube['color']] = $cube['count'];
                    continue;
                }

                $minColors[$cube['color']] = max($minColors[$cube['color']], $cube['count']);
            }

            $powers[] = $minColors['red'] * $minColors['green'] * $minColors['blue'];
        }

        return array_sum($powers);
    }

    private function parseGame(string $line): array
    {
        $data = explode(':', $line);

        sscanf($data[0], 'Game %d', $gameId);

        $subsets = explode(';', $data[1]);

        $subsets = array_map(function ($subset) {
            return explode(',', $subset);
        }, $subsets);

        $subsets = array_merge_recursive(...$subsets);

        $cubes = array_map(function ($grab) {
            sscanf(trim($grab), '%d %s', $count, $color);
            return ['count' => $count, 'color' => $color];
        }, $subsets);

        return [$gameId, $cubes];
    }
}
