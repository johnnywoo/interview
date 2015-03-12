<?php

class Desk
{
    private $figures = array();
    private $lastIsBlack = true;

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

        if (isset($this->figures[$xFrom][$yFrom])) {
        	
        	$figure = $this->figures[$xFrom][$yFrom];
        	
        	$this->checkOrder($figure);
        	$this->checkAcrossFigure($xFrom, $yFrom, $xTo, $yTo);
        	
        	if (!isset($this->figures[$xTo][$yTo])) {
        		$figure->checkMove($xFrom, $yFrom, $xTo, $yTo);
        	} else {
        		$figure->checkAttack($xFrom, $yFrom, $xTo, $yTo);
        	}
        	
            $this->figures[$xTo][$yTo] = $this->figures[$xFrom][$yFrom];
        }
        
        unset($this->figures[$xFrom][$yFrom]);
    }
    
    private function checkOrder($figure) {
    	
    	if ($this->lastIsBlack != $figure->isBlack()) {
    		$this->lastIsBlack = !$this->lastIsBlack;
    	} else {
    		throw new \Exception("Wrong move order");
    	}
    }
    
    private function checkAcrossFigure($xFrom, $yFrom, $xTo, $yTo) {
    	
    	if ($xFrom == $xTo) {
    		
    		$this->checkVerticalAcross($xFrom, $yFrom, $xTo, $yTo);
    		
    	} else if ($yFrom == $yTo) {
    		
    		$this->checkHorizontalAcross($xFrom, $yFrom, $xTo, $yTo);
    		
    	} else if (abs($xFrom - $xTo) == abs($yFrom - $yTo)) {
    		$this->checkDiagonalAcross($xFrom, $yFrom, $xTo, $yTo);
    	}
    }
    
    private function checkVerticalAcross($xFrom, $yFrom, $xTo, $yTo) {
    	
    	for ($i = $yFrom + 1; $i < $yTo; $i++) {
    		if (isset($this->figures[$xFrom][$i])) {
    			throw new \Exception("Could not across figure at: " . $xFrom . $i);
    		}
    	}
    }
    
    private function checkHorizontalAcross($xFrom, $yFrom, $xTo, $yTo) {
    	/** not implemented for the Pawn task */
    }
    
    private function checkDiagonalAcross($xFrom, $yFrom, $xTo, $yTo) {
    	/** not implemented for the Pawn task */
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
}
