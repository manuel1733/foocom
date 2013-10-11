<?php

defined('admin') or die ('no direct access');

class Suppliers extends Controller {
    private $db;

    function Suppliers() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        $template = new Template('suppliers', 'suppliers');
        $template->set_ar('suppliers', $this->db->all());
        $template->display();
    }
}
