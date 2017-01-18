<?php

class Knight extends Figure {
    public function __toString() {
        return $this->isBlack ? '♞' : '♘';
    }
}
