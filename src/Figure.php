<?php

abstract class Figure
{
    private $isBlack;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }
    
    public function isBlack()
    {
    	return $this->isBlack;
    }
    
    public abstract function checkMove($xFrom, $yFrom, $xTo, $yTo);
    
    public abstract function checkAttack($xFrom, $yFrom, $xTo, $yTo);

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \Exception("Not implemented");
    }
}
