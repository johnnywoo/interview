<?php

class Queen extends Figure {
    public function __toString() {
        return $this->isBlack ? '♛' : '♕';
    }
}
