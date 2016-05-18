<?php

class Figure
{
    protected $isBlack;

    private $wasMoved = false;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \Exception("Not implemented");
    }

    /**
     * @return bool
     */
    public function isBlack()
    {
        return $this->isBlack;
    }

    /**
     * @return bool
     */
    public function wasMoved()
    {
        return $this->wasMoved;
    }

    /**
     * @param $xFrom
     * @param $yFrom
     * @param $xTo
     * @param $yTo
     * @return bool
     * @throws Exception
     */
    public function performMove($xFrom, $yFrom, $xTo, $yTo)
    {
        if ($this->validateMove($xFrom, $yFrom, $xTo, $yTo)) {
            $this->wasMoved = true;
        } else {
            throw new \Exception("Invalid move");
        }

        return true;
    }

    /**
     * @param $xFrom
     * @param $yFrom
     * @param $xTo
     * @param $yTo
     * @return mixed
     */
    protected function validateMove($xFrom, $yFrom, $xTo, $yTo)
    {
        return true;
    }
}
