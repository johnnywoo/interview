<?php

class Pawn extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    /**
     * @param $xFrom
     * @param $yFrom
     * @param $xTo
     * @param $yTo
     * @return mixed
     * @throws Exception
     */
    protected function validateMove($xFrom, $yFrom, $xTo, $yTo)
    {
        if ($this->isBlack()) {
            if (($this->isBlack() && $yTo > $yFrom) || (!$this->isBlack() && $yTo < $yFrom)) {
                throw new \Exception('Нельзя ходить назад');
            }
        }

        if ($xFrom === $xTo) {
            return $this->wasMoved() ? (abs($yTo - $yFrom) === 1) : (abs($yTo - $yFrom) > 0 && abs($yTo - $yFrom) <= 2);
        } else {
            return $yTo - $yFrom === 1;
        }
    }
}
