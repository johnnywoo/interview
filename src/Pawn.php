<?php

class Pawn extends Figure
{
	private $isFirstMove = true;
	
	public function isFirstMove() {
		return $this->isFirstMove;
	}
	
	public function checkMove($xFrom, $yFrom, $xTo, $yTo)
	{
		$xDiff = abs($xFrom - $xTo);
		$yDiff = abs($yFrom - $yTo);
		
		if ($this->isFirstMove) {
			
			if ($yDiff != 1 && $yDiff != 2) {
				throw new \Exception("Could not move: " . $yDiff);
			}
			
		} else if ($yDiff != 1) {
			throw new \Exception("Could not move: " . $yDiff);
		}
		
		if ($xFrom != $xTo) {
			throw new \Exception("Could not move diagonally");
		}
		
		$this->isFirstMove = false;
	}
    
    public function checkAttack($xFrom, $yFrom, $xTo, $yTo)
    {
    	$xDiff = abs($xFrom - $xTo);
    	$yDiff = abs($yFrom - $yTo);
    	
    	if ($xDiff != 1 && $yDiff != 1) {
    		throw new \Exception("Could not attack this way");
    	}
    	
    	$this->isFirstMove = false;
    }
	
    public function __toString()
    {
        return $this->isBlack() ? '♟' : '♙';
    }
}
