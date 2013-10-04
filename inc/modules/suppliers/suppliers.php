<?php

defined('main') or die ('no direct access');

include 'suppliers.db.php';

class Suppliers extends Controller {
    private $db;

    function Suppliers() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        $template = new Template('suppliers/suppliers');
        $template->set_ar('suppliers', $this->db->all());
        $template->display();
    }
}
