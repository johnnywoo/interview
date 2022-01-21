<?php

/**
 * Внимание!
 * ЭТОТ ФАЙЛ НЕ ОТНОСИТСЯ К ТЕСТОВОМУ ЗАДАНИЮ.
 * ДЛЯ РЕШЕНИЯ ЗАДАЧИ НЕ НУЖНО СМОТРЕТЬ В КОД ЭТОГО ФАЙЛА.
 */

require_once __DIR__ . '/vendor/autoload.php';

$info     = '';
$score    = 0;
$maxScore = 0;
foreach (getGroups() as $group) {
    $groupTitle = $group['title'];
    $groupScore = $group['score'];
    $groupTests = $group['tests'];

    $passed = 0;
    $total  = count($groupTests);
    foreach ($groupTests as $testData) {
        $moves     = $testData[1];
        $isCorrect = $testData[2] != 'error';

        $out = [];
        exec('php chess.php ' . $moves, $out, $err);
        if (($isCorrect && $err == 0) || (!$isCorrect && $err != 0)) {
            $passed++;
        } elseif (isset($argv[1]) && $argv[1] == '-v') {
            $info .= '[failed] ' . $testData[0] . ": $moves\n";
        }
    }

    $score += round($groupScore * $passed / count($groupTests));

    $maxScore += $groupScore;
}

// Общая сумма должна быть ровно 100
if ($maxScore != 100) {
    throw new LogicException("Unexpected max score: $maxScore");
}

echo "Your score: $score\n";

if ($info) {
    echo "\n";
    echo $info;
}

function getGroups() {
    return [
        [
            'title' => 'Rotation tests',
            'score' => 15,
            'tests' => [
                [
                    'No moves',
                    '',
                    'correct',
                ],
                [
                    'Color rotation correct',
                    'e2-e3 e7-e5 b2-b4',
                    'correct',
                ],
                [
                    'Color rotation error',
                    'e2-e3 e7-e5 b2-b4 e3-e4',
                    'error',
                ],
                [
                    'Black can not move first',
                    'e7-e6',
                    'error',
                ],
            ],
        ],
        [
            'title' => 'Pawn tests',
            'score' => 35,
            'tests' => [
                [
                    'Pawn can move two squares on first move',
                    'e2-e4',
                    'correct',
                ],
                [
                    'Pawn can not move three steps forward',
                    'e2-e5',
                    'error',
                ],
                [
                    'Pawn moves one square vertically',
                    'e2-e3 d7-d6 e3-e4',
                    'correct',
                ],
                [
                    'Pawn captures diagonally',
                    'e2-e4 d7-d5 e4-d5',
                    'correct',
                ],
                [
                    'Simple error',
                    'e2-e8',
                    'error',
                ],
                [
                    'Pawn can not move diagonally',
                    'e2-d3',
                    'error',
                ],
                [
                    'Pawn can not capture vertically',
                    'e2-e4 e7-e5 e4-d5',
                    'error',
                ],
                [
                    'Pawn can not move farther one square',
                    'e2-e3 d7-d6 e3-e5',
                    'error',
                ],
                [
                    'Pawn can not move across figure',
                    'e2-e3 a7-a5 e3-e4 a5-a4 e4-e5 a4-a3 a2-a4',
                    'error',
                ],
            ],
        ],
        [
            'title' => 'Extended 1',
            'score' => 40,
            'tests' => [
                [
                    'White pawn can not move back',
                    'e2-e4 b7-b6 e4-e3',
                    'error',
                ],
                [
                    'Black pawn can not move back',
                    'e2-e4 b7-b5 e4-e5 b5-b6',
                    'error',
                ],
                [
                    'White pawn can not move back diagonally',
                    'e2-e4 b7-b6 e4-f3',
                    'error',
                ],
                [
                    'Black pawn can not move back diagonally',
                    'e2-e4 b7-b5 e4-e5 b5-c6',
                    'error',
                ],
                [
                    'White pawn can not capture back diagonally',
                    'e2-e4 f7-f5 e4-e5 f5-f4 e5-f4',
                    'error',
                ],
                [
                    'Black pawn can not capture back diagonally',
                    'e2-e4 d7-d5 e4-e5 d5-d4 a2-a3 d4-e5',
                    'error',
                ],
                [
                    'White pawn can not move two forward diagonally',
                    'a2-a3 e7-f5',
                    'error',
                ],
                [
                    'Black pawn can not move two forward diagonally',
                    'e2-f4',
                    'error',
                ],
                [
                    'Pawn can not capture two steps left diagonally',
                    'e2-e4 c7-c5 e4-c5',
                    'error',
                ],
                [
                    'Pawn can not capture two steps forward diagonally',
                    'e2-e3 d7-d5 e3-d5',
                    'error',
                ],
            ],
        ],
        [
            'title' => 'Extended 2',
            'score' => 10,
            'tests' => [
                [
                    'Black can not capture black',
                    'a2-a3 f7-f5 b2-b3 e7-e5 c2-c3 e5-e4 d2-d3 f5-e4',
                    'error',
                ],
                [
                    'White pawn can not capture two forward diagonally',
                    'a2-a3 f7-f5 a3-a4 f5-f4 e2-f4',
                    'error',
                ],
                [
                    'Black pawn can not capture two forward diagonally',
                    'f2-f4 a7-a6 f4-f5 e7-f5',
                    'error',
                ],
            ],
        ],
    ];
}
