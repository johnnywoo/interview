<?php

require_once 'Figure.php';

class Bishop extends Figure
{
	public function checkMove($xFrom, $yFrom, $xTo, $yTo)
	{
	}
    
    public function checkAttack($xFrom, $yFrom, $xTo, $yTo)
    {
    }
	
    public function __toString()
    {
        return $this->isBlack() ? '♝' : '♗';
    }
}
