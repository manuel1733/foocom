<?php

defined('main') or die ('no direct access');

class Products_Database {
    private $db;

    function Products_Database(Database $db) {
        $this->db = $db;
    }

    function suppliers_not($id) {
        $suppliers = array();
        $iter = $this->db->query("SELECT s.user_id, u.name FROM suppliers s, users u WHERE s.user_id = u.id AND u.id NOT IN (SELECT supplier_id FROM product_suppliers WHERE product_id = :id)", array('id' => $id));
        foreach ($iter as $row) {
            $suppliers[$row['user_id']] = $row['name'];
        }
        return $suppliers;
    }

    function suppliers_for($id) {
        return $this->db->query("SELECT u.id, u.name, ps.purchase_price, ps.order_quantity, ps.product_number FROM product_suppliers ps, suppliers s, users u WHERE u.id = s.user_id AND s.user_id = ps.supplier_id AND ps.product_id = :id", array('id' => $id));
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
        return $this->db->query("SELECT l.id, l.name, p.product_id selected
            FROM allergens l LEFT JOIN product_allergens p
            ON l.id = p.allergen_id AND p.product_id = :id", array('id' => $id));
    }

    function labels_for($id) {
        return $this->db->query("SELECT l.id, l.name, p.product_id selected
            FROM labels l LEFT JOIN product_labels p
            ON l.id = p.label_id AND p.product_id = :id", array('id' => $id));
    }

    function product_groups_for($id) {
        return $this->db->query("SELECT l.id, l.name, p.product_id selected
            FROM product_groups l LEFT JOIN product_product_groups p
            ON l.id = p.product_group_id AND p.product_id = :id", array('id' => $id));
    }

    function customer_groups_for($id) {
        return $this->db->query("SELECT * FROM customer_groups g
            LEFT JOIN product_customer_groups p
            ON g.id = p.customer_group_id AND p.product_id = :id", array('id' => $id));
    }

    function insert($fields) {
        $this->db->run("INSERT INTO products (name) VALUES (:name)", $fields);
        return $this->db->insert_id();
    }

    function update($id, $fields) {
        $fields['id'] = $id;
        $this->db->run("UPDATE products SET
            name = :name,
            ean = :ean,
            description = :description,
            min_stock = :min_stock,
            order_quantity = :order_quantity,
            food_value = :food_value,
            ingredients = :ingredients,
            producer_id = :producer_id
            WHERE id = :id", $fields);
    }

    function get($id) {
        return $this->db->query_for_row("SELECT * FROM products WHERE id = :id", array('id' => $id));
    }

    function all() {
        return $this->db->query("SELECT * FROM products", array());
    }

    function delete_select($table, $product_id, $select_id) {
        $fields = array('product_id' => $product_id, 'select_id' => $select_id);
        $column_name = substr($table, 0, -1);
        $this->db->run("DELETE FROM product_" . $table . " WHERE product_id = :product_id AND " . $column_name . "_id = :select_id", $fields);
    }

    function add_select($table, $product_id, $select_id) {
        $fields = array('product_id' => $product_id, 'select_id' => $select_id);
        $this->db->run("INSERT INTO product_" . $table . " VALUES(:product_id, :select_id)", $fields);
    }

    function update_customer_group($product_id, $group_id, $price, $display) {
        $fields = array('product_id' => $product_id, 'customer_group_id' => $group_id, 'price' => $price, 'display' => $display);
        if (0 == $this->db->query_for_one("SELECT COUNT(*) FROM product_customer_groups WHERE product_id = :product_id AND customer_group_id = :customer_group_id", array('product_id' => $product_id, 'customer_group_id' => $group_id))) {
            $this->db->run("INSERT INTO product_customer_groups VALUES(:product_id, :customer_group_id, :price, :display)", $fields);
        } else {
            $this->db->run("UPDATE product_customer_groups SET price = :price, display = :display WHERE product_id = :product_id AND customer_group_id = :customer_group_id", $fields);
        }
    }

    function add_supplier($id, $supplier_id) {
        $fields = array('id' => $id, 'supplier_id' => $supplier_id);
        $this->db->run("INSERT INTO product_suppliers (product_id, supplier_id) VALUES(:id, :supplier_id)", $fields);
    }

    function update_supplier($id, $supplier_id, $product_number, $purchase_price, $order_quantity) {
        $fields = array('id' => $id, 'supplier_id' => $supplier_id, 'product_number' => $product_number, 'purchase_price' => $purchase_price, 'order_quantity' => $order_quantity);
        $this->db->run("UPDATE product_suppliers SET product_number = :product_number, purchase_price = :purchase_price, order_quantity = :order_quantity WHERE product_id = :id AND supplier_id = :supplier_id", $fields);
    }

    function delete_supplier($id, $supplier_id) {
        $fields = array('id' => $id, 'supplier_id' => $supplier_id);
        $this->db->run("DELETE FROM product_suppliers WHERE product_id = :id AND supplier_id = :supplier_id", $fields);
    }
}
