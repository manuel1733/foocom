<?php

class Customer extends Eloquent {

    public function group()
    {
        return $this->hasOne('CustomerGroup');
    }
}
