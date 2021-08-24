<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    $board = new Board();

    $args = $argv;
    array_shift($args);

    foreach ($args as $move) {
        $board->move($move);
    }

    $board->dump();
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
