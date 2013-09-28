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

    function allergens() {
        $suppliers = array();
        $iter = $this->db->query("SELECT * FROM allergens", array());
        foreach ($iter as $row) {
            $suppliers[$row['id']] = $row['name'];
        }
        return $suppliers;
    }

    function labels() {
        $suppliers = array();
        $iter = $this->db->query("SELECT * FROM labels", array());
        foreach ($iter as $row) {
            $suppliers[$row['id']] = $row['name'];
        }
        return $suppliers;
    }
}