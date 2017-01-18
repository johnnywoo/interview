<?php

class King extends Figure {
    public function __toString() {
        return $this->isBlack ? '♚' : '♔';
    }
}
