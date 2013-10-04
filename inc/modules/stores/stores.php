<?php

include 'stores.db.php';

class Stores extends Controller {
    private $db;

    function Stores() {
        $this->db = new Stores_Database();
    }

    function handle(Request $request) {
        $template = new Template('stores/stores');
        $template->set_ar('stores', $this->db->stores());
        $template->display();
    }
}
