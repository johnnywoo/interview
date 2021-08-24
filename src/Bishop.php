<?php

class Bishop extends Figure {
    public function __toString() {
        return $this->isBlack ? '♝' : '♗';
    }
}
