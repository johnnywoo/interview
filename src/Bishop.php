<?php

require_once __DIR__ . '/Figure.php';

class Bishop extends Figure {
    public function __toString() {
        return $this->isBlack ? '♝' : '♗';
    }
}
