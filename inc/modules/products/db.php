<?php

class Products_Database extends Database {

    public function products_group($id) {
        return $this->query("SELECT * FROM products p, product_product_groups g WHERE p.id = g.product_group_id AND g.product_group_id = ?", array($id));
    }

    public function products_allergen($id) {
        return $this->query("SELECT * FROM products p, product_allergens a WHERE p.id = a.product_id AND a.allergen_id = ?", array($id));
    }

    public function products_label($id) {
        return $this->query("SELECT * FROM products p, product_labels l WHERE p.id = l.product_id AND l.label_id = ?", array($id));
    }

    function get($id) {
        return $this->query_for_row("SELECT * FROM products WHERE id = :id", array('id' => $id));
    }
}
