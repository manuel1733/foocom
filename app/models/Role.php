<?php

class Role extends Eloquent {

    public function permissions() {
        return $this->belongsToMany('Permission');
    }
}
