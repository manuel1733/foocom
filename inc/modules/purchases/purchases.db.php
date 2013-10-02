<?php

class Purchases_Database extends Database {

    function suppliers() {
        return $this->query("SELECT user_id id, name FROM suppliers");
    }

}

