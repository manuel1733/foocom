<?php

class Products_Labels_Box {

    private $db;

    public function Products_Labels_Box() {
        $this->db = new Products_Database();
    }

    public function display() {
        $template = new Template('products', 'labels.box');
        $template->set_ar('labels', $this->db->labels());
        $template->display();
    }
}
