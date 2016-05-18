<?php

class Desk
{
    private $figures = array();

    private $isBlackMove = false;

    public function __construct()
    {
        $this->figures['a'][1] = new Rook(false);
        $this->figures['b'][1] = new Knight(false);
        $this->figures['c'][1] = new Bishop(false);
        $this->figures['d'][1] = new Queen(false);
        $this->figures['e'][1] = new King(false);
        $this->figures['f'][1] = new Bishop(false);
        $this->figures['g'][1] = new Knight(false);
        $this->figures['h'][1] = new Rook(false);

        $this->figures['a'][2] = new Pawn(false);
        $this->figures['b'][2] = new Pawn(false);
        $this->figures['c'][2] = new Pawn(false);
        $this->figures['d'][2] = new Pawn(false);
        $this->figures['e'][2] = new Pawn(false);
        $this->figures['f'][2] = new Pawn(false);
        $this->figures['g'][2] = new Pawn(false);
        $this->figures['h'][2] = new Pawn(false);

        $this->figures['a'][7] = new Pawn(true);
        $this->figures['b'][7] = new Pawn(true);
        $this->figures['c'][7] = new Pawn(true);
        $this->figures['d'][7] = new Pawn(true);
        $this->figures['e'][7] = new Pawn(true);
        $this->figures['f'][7] = new Pawn(true);
        $this->figures['g'][7] = new Pawn(true);
        $this->figures['h'][7] = new Pawn(true);

        $this->figures['a'][8] = new Rook(true);
        $this->figures['b'][8] = new Knight(true);
        $this->figures['c'][8] = new Bishop(true);
        $this->figures['d'][8] = new Queen(true);
        $this->figures['e'][8] = new King(true);
        $this->figures['f'][8] = new Bishop(true);
        $this->figures['g'][8] = new Knight(true);
        $this->figures['h'][8] = new Rook(true);
    }

    public function move($move)
    {
        if (!preg_match('/^([a-h])(\d)-([a-h])(\d)$/', $move, $match)) {
            throw new \Exception("Incorrect move");
        }

        $xFrom = $match[1];
        $yFrom = $match[2];
        $xTo = $match[3];
        $yTo = $match[4];

        if (isset($this->figures[$xFrom][$yFrom]) && $this->figures[$xFrom][$yFrom] instanceof \Figure) {
            /**
             * @var Figure $figureFrom
             */
            $figureFrom = $this->figures[$xFrom][$yFrom];
            if ($this->isBlackMove && !$figureFrom->isBlack()) {
                throw new \Exception('Now is black turn');
            }

            if (
                $figureFrom->performMove($xFrom, $yFrom, $xTo, $yTo)
                && $this->validateMove($xFrom, $yFrom, $xTo, $yTo)
            ) {
                $this->figures[$xTo][$yTo] = $figureFrom;
                $this->isBlackMove = !$this->isBlackMove;
            }
        }

        unset($this->figures[$xFrom][$yFrom]);
    }

    public function dump()
    {
        for ($y = 8; $y >= 1; $y--) {
            echo "$y ";
            for ($x = 'a'; $x <= 'h'; $x++) {
                if (isset($this->figures[$x][$y])) {
                    echo $this->figures[$x][$y];
                } else {
                    echo '-';
                }
            }
            echo "\n";
        }
        echo "  abcdefgh\n";
    }

    /**
     * @param $xFrom
     * @param $yFrom
     * @param $xTo
     * @param $yTo
     * @return bool
     * @throws Exception
     */
    private function validateMove($xFrom, $yFrom, $xTo, $yTo)
    {
        $yFrom = (int)$yFrom;
        $yTo = (int)$yTo;

        //@todo Пешка не может перепрыгивать через другие фигуры;
        //@todo Пешка может бить фигуры противника только по диагонали вперёд на одну клетку;

        /**
         * @var Figure $figureFrom
         */
        $figureFrom = $this->figures[$xFrom][$yFrom];

        if ($figureFrom instanceof \Pawn) {
            if ($xTo !== $xFrom) {
                /**
                 * @var Figure $figureTo
                 */
                $figureTo = (isset($this->figures[$xTo][$yTo])) ? $this->figures[$xTo][$yTo] : null;

                if (!$figureTo) {
                    throw new \Exception('Никого не едим');
                }

                if ($figureTo->isBlack() === $figureFrom->isBlack()) {
                    throw new \Exception('Едим свою фигуру');
                }
            } else {
                if (abs($yTo - $yFrom) === 2) {
                    $yToCheck = ($yTo > $yFrom) ? $yTo - 1 : $yTo + 1;
                    if (isset($this->figures[$xFrom][$yToCheck])) {
                        throw new \Exception('Перепрыгиваем через фигуру');
                    }
                }
            }
        }

        return true;
    }
}
