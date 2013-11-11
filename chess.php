<?php

set_exception_handler(function (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
});

foreach (glob('src/*.php') as $file) {
    require_once $file;
}

$desk = new Desk();

$args = $argv;
array_shift($args);

foreach ($args as $move) {
    $desk->move($move);
}

$desk->dump();
