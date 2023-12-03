<?php

declare(strict_types=1);

namespace Kinobi\AdventOfCode2023\Helpers;

use Generator;

trait Reader {
    private function readInput(string $filename): Generator
    {
        $input = fopen($filename, 'r');

        while (!feof($input)) {
            yield fgets($input);
        }
    }
}