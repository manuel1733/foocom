<?php

class Change extends Eloquent {

    public function employee() {
        return $this->belongsTo('Employee');
    }
}
