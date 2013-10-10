<?php

include 'inc/modules/customers/db.php';

class Customers_Basket extends Controller {
    private $db;

    function Customers_Basket() {
        $this->db = new Customers_Database();
    }

    function handle(Request $request) {

    }
}
