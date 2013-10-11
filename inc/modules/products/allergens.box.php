<?php

class Products_Allergens_Box {

    private $db;

    public function Products_Allergens_Box() {
        $this->db = new Products_Database();
    }

    public function display() {
        $template = new Template('products', 'allergens.box');
        $template->set_ar('allergens', $this->db->allergens());
        $template->display();
    }
}
