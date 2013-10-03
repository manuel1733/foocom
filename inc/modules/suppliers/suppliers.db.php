<?php

defined('main') or die ('no direct access');

class Suppliers_Database extends Database {

    function insert(array $fields) {
        $this->run("INSERT INTO users (id, name) VALUES (null, :name)", $fields);
        $user_id = $this->insert_id();
        $fields['user_id'] = $user_id;
        $this->run("INSERT INTO suppliers (user_id, name) VALUES (:user_id, :name)", $fields);
        return $user_id;
    }

    function update($user_id, array $fields) {
        $user_fields = array('user_id' => $user_id, 'name' => $fields['name']);
        $this->run("UPDATE users SET name = :name WHERE id = :user_id", $user_fields);
        $fields['user_id'] = $user_id;
        $this->run("UPDATE suppliers SET name = :name, addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE user_id = :user_id", $fields);
    }

    function delete($user_id) {
        $fields = array('user_id' => $user_id);
        $this->run("DELETE FROM suppliers WHERE user_id = :user_id", $fields);
        $this->run("DELETE FROM users WHERE id = :user_id", $fields);
    }

    function get($user_id) {
        return $this->query_for_row("SELECT * FROM suppliers WHERE user_id = :user_id", array('user_id' => $user_id));
    }

    function all() {
        return $this->query("SELECT user_id, name FROM suppliers");
    }

    function countries() {
        return $this->query("SELECT * FROM countries");
    }

    function create_order($supplier_id) {
        $fields = array('supplier_id' => $supplier_id);
        $this->run("INSERT INTO supplier_orders (id, supplier_id) VALUES (null, :supplier_id)", $fields);
        return $this->insert_id();
    }

    function order_product_count($order_id) {
        $fields = array('order_id' => $order_id);
        return $this->query_for_one("SELECT COUNT(*) FROM supplier_order_products WHERE order_id = :order_id", $fields);
    }

    function order_product_suggestion($order_id) {
        $fields = array('order_id' => $order_id);
        $supplier_id = $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
        $fields = array('supplier_id' => $supplier_id);
        return $this->query("SELECT
                p.id,
                p.name,
                p.order_quantity,
                p.min_stock,
                ps.product_number,
                ps.purchase_price,
                ps.order_quantity as supplier_order_quantity,
                COALESCE(b.stock_amount, 0) as stock_amount,
                GREATEST(p.order_quantity, ps.order_quantity) as order_amount
            FROM product_suppliers ps
                INNER JOIN products p ON p.id = ps.product_id
                LEFT JOIN (SELECT product_id, SUM(stock_amount) stock_amount FROM batches GROUP BY product_id) b ON p.id = b.product_id
            WHERE supplier_id = :supplier_id
              AND p.min_stock > 0
              AND COALESCE(b.stock_amount, 0) < p.min_stock
            ORDER BY ", $fields);
    }

    function order_products($order_id) {
        $fields = array('order_id' => $order_id);
        return $this->query("SELECT * FROM supplier_order_products ", $fields);
    }
}
