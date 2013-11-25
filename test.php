<?php

class Test extends \PHPUnit_Framework_TestCase
{
    public function testNoMoves()
    {
        $this->runFile('tests/001-no-moves.test');
    }

    public function testSimpleError()
    {
        $this->runFile('tests/011-simple-error.test');
    }

    public function testSimple()
    {
        $this->runFile('tests/012-simple-move.test');
    }

    public function testColorRotationError()
    {
        $this->runFile('tests/013-color-rotation-error.test');
    }

    public function testColorRotationCorrect()
    {
        $this->runFile('tests/014-color-rotation-correct.test');
    }

    public function testPawnMovesOneSquareVertically()
    {
        $this->runFile('tests/021-pawn-moves-one-square-vertically.test');
    }

    public function testPawnCanMoveTwoSquaresOnFirstMove()
    {
        $this->runFile('tests/022-pawn-can-move-two-squares-on-first-move.test');
    }

    public function testPawnCanNotMoveDiagonally()
    {
        $this->runFile('tests/023-pawn-can-not-move-diagonally.test');
    }

    public function testPawnCapturesDiagonally()
    {
        $this->runFile('tests/024-pawn-captures-diagonally.test');
    }

    public function testPawnCanNotCaptureVertically()
    {
        $this->runFile('tests/025-pawn-can-not-capture-vertically.test');
    }

    public function testPawnCanNotMoveFartherOneSquare()
    {
        $this->runFile('tests/026-pawn-can-not-move-farther-one-square.test');
    }

    public function testPawnCanNotMoveAcrossFigure()
    {
        $this->runFile('tests/027-pawn-can-not-move-across-figure.test');
    }


    /**
     * Test file structure
     *
     * line 1: moves as arguments to chess.php
     * line 2: 'correct' if all moves are correct, 'error' if there are incorrect moves
     * Other lines: output of chess.php (final chess board) if all moves are correct
     *
     * @param string $file
     */
    private function runFile($file)
    {
        $lines = file($file);
        $moves = trim($lines[0]);
        $movesDesc = $moves ?: '(no moves)';
        unset($lines[0]);

        $isCorrect = trim($lines[1]) != 'error';
        unset($lines[1]);

        $redColor = '';
        $noColor  = '';
        if (posix_isatty(STDOUT)) {
            $redColor = "\033[31m";
            $noColor  = "\033[m";
        }

        $out = array();
        exec('php chess.php ' . $moves, $out, $err);
        if ($isCorrect) {
            $this->assertEquals(0, $err, $redColor . "Moves are correct, but chess.php thinks there is an error:\n" . $movesDesc . $noColor . "\n");
            $this->assertEquals(join("", $lines), join("\n", $out) . "\n");
        } else {
            $this->assertNotEquals(0, $err, $redColor . "Moves are invalid, but chess.php does not detect that:\n" . $movesDesc . $noColor . "\n");
        }
    }
}
