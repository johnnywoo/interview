<?php

class Test extends \PHPUnit_Framework_TestCase
{
    public function testNoMoves()
    {
        $this->runFile('tests/no-moves.test');
    }

    public function testSimple()
    {
        $this->runFile('tests/simple-move.test');
    }

    public function testSimpleError()
    {
        $this->runFile('tests/simple-error.test');
    }

    private function runFile($file)
    {
        $lines = file($file);
        $moves = $lines[0];
        unset($lines[0]);

        $isCorrect = trim($lines[1]) != 'error';
        unset($lines[1]);

        $out = array();
        exec('php chess.php ' . $moves, $out, $err);
        if ($isCorrect) {
            $this->assertEquals(0, $err);
            $this->assertEquals(join("", $lines), join("\n", $out) . "\n");
        } else {
            $this->assertNotEquals(0, $err);
        }
    }
}
