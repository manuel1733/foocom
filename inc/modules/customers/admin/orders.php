<?php

defined('admin') or die ('no direct access');

class Customers_Orders extends Controller {
    private $db;

    function Customers_Orders() {
        $this->db = new Customers_Database();
    }

    function handle(Request $request) {
        $template = new Template('customers', 'orders');
        $template->set_ar('orders', $this->db->orders());
        $template->display();
    }
}
