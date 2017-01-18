<?php

class Pawn extends Figure {
    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }
}
