<?php

defined('admin') or die ('no direct access');

include 'db.php';

class Customers_Create extends Controller {
    private $db;

    function Customers_Create() {
        $this->db = new Customers_Database();
    }

    function handle(Request $request) {
        if ($request->is_post('customers-create')) {
            $id = $this->db->insert($request->populate(array('name' => '')));
            $request->forward('customers-change-' . $id);
        }
    }
}
