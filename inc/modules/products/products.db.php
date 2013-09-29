<?php

defined('main') or die ('no direct access');

class Products_Database {
    private $db;

    function Products_Database(Database $db) {
        $this->db = $db;
    }

    function suppliers() {
        $suppliers = array();
        $iter = $this->db->query("SELECT s.user_id, u.name FROM suppliers s, users u WHERE s.user_id = u.id", array());
        foreach ($iter as $row) {
            $suppliers[$row['user_id']] = $row['name'];
        }
        return $suppliers;
    }

    function suppliers_for($id) {
        return $this->db->query("SELECT u.id, u.name, ps.purchase_price, ps.order_quantity, ps.supplier_number FROM product_suppliers ps, suppliers s, users u WHERE u.id = s.user_id AND s.user_id = ps.supplier_id AND ps.product_id = :id", array('id' => $id));
    }

    function producers() {
        $producers = array();
        $iter = $this->db->query("SELECT * FROM producers", array());
        foreach ($iter as $row) {
            $producers[$row['id']] = $row['name'];
        }
        return $producers;
    }

    function allergens_for($id) {
            return $this->db->query("SELECT l.id, l.name, p.product_id selected FROM allergens l LEFT JOIN product_allergens p ON l.id = p.allergen_id AND p.product_id = :id", array('id' => $id));
    }

    function labels_for($id) {
        return $this->db->query("SELECT l.id, l.name, p.product_id selected FROM labels l LEFT JOIN product_labels p ON l.id = p.label_id AND p.product_id = :id", array('id' => $id));
    }

    function product_groups_for($id) {
        return $this->db->query("SELECT l.id, l.name, p.product_id selected FROM product_groups l LEFT JOIN product_product_groups p ON l.id = p.product_group_id AND p.product_id = :id", array('id' => $id));
    }

    function customer_groups_for($id) {
            return $this->db->query("SELECT l.id, l.name, p.product_id selected FROM product_groups l LEFT JOIN product_product_groups p ON l.id = p.product_group_id AND p.product_id = :id", array('id' => $id));
    }

    function insert($fields) {
        $this->db->run("INSERT INTO products (name) VALUES (:name)", $fields);
        return $this->db->insert_id();
    }
}
