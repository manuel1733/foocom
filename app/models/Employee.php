<?php

class Employee extends Eloquent {

    protected $guarded = array('id', 'password');

    public function role() {
        return $this->belongsTo('Role');
    }
}
