<?php

class Rook extends Figure {
    public function __toString() {
        return $this->isBlack ? '♜' : '♖';
    }
}
