<?php

class SupplierOrder extends Eloquent {
    public function supplier() {
        return $this->belongsTo('Supplier');
    }
}
