<?php

class Products_Groups_Box {

    private $db;

    public function Products_Groups_Box() {
        $this->db = new Products_Database();
    }

    public function display() {
        $template = new Template('products', 'groups.box');
        $template->set_ar('groups', $this->db->product_groups());
        $template->display();
    }
}
