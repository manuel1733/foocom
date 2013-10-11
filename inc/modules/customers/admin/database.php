<?php

defined('admin') or die ('no direct access');

class Customers_Database extends Database {

    function insert(array $fields) {
        $this->run("INSERT INTO customers (id, name) VALUES (null, :name)", $fields);
        return $this->insert_id();
    }

    function update($id, array $fields) {
        $fields['id'] = $id;
        $this->run("UPDATE customers SET name = :name, addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE id = :id", $fields);
    }

    function delete($user_id) {
        $fields = array('user_id' => $user_id);
        $this->run("DELETE FROM customers WHERE user_id = :user_id", $fields);
    }

    function get($id) {
        return $this->query_for_row("SELECT * FROM customers WHERE id = :id", array('id' => $id));
    }

    function all() {
        return $this->query("SELECT id, name FROM customers");
    }

    function countries() {
        return $this->query("SELECT * FROM countries");
    }

    // ORDERS

    function orders() {
        return $this->query("SELECT
                o.id, o.customer_id, c.name, o.payment_method, o.delivery_method,
                SUM(p.order_quantity) product_count,
                SUM(p.order_quantity * p.price) order_volume
            FROM customer_orders o, customers c, customer_order_products p
            WHERE c.id = o.customer_id AND p.order_id = o.id
            GROUP BY o.id, o.customer_id, c.name, o.payment_method, o.delivery_method");
    }

    // GROUPS

    function groups_insert(array $fields) {
        $this->run("INSERT INTO customer_groups (id, name, discount) VALUES (null, :name, :discount)", $fields);
        return $this->insert_id();
    }

    function groups_update($id, array $fields) {
        $fields['id'] = $id;
        $this->run("UPDATE customer_groups SET name = :name, discount = :discount WHERE id = :id", $fields);
    }

    function groups_delete($id) {
        $this->run("DELETE FROM customer_groups WHERE id = :id", array('id' => $id));
    }

    function groups_get($id) {
        return $this->query_for_row("SELECT * FROM customer_groups WHERE id = :id", array('id' => $id));
    }

    function groups_all() {
        return $this->query("SELECT * FROM customer_groups", array());
    }
}
