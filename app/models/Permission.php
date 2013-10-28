<?php

class Permission extends Eloquent {
    public function roles() {
        return $this->belongsToMany('Role');
    }
}
