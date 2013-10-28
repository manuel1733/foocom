<?php

class Customers_Database extends Database {
    function countries() {
        return $this->query("SELECT * FROM countries");
    }

    function login_is_valid(array $fields) {
        return $this->query_for_one("SELECT COUNT(*) FROM customers WHERE mail = :mail AND password = :password", $fields);
    }

    function get_by_mail($mail) {
        return $this->query_for_row("SELECT * FROM customers WHERE mail = ?", array($mail));
    }

    function insert(array $fields) {
        $this->run("INSERT INTO customers (id, name, addition, street, zipcode, city, tel, fax, mail, country, password) VALUES (null, :name, :addition, :street, :zipcode, :city, :tel, :fax, :mail, :country, :password)", $fields);
        return $this->insert_id();
    }

    function order_insert(array $fields, array $basket) {
        $fields['customer_id'] = $_SESSION['customer']['id'];
        $this->run("INSERT INTO customer_orders (id, customer_id, payment_method, delivery_method, customer_comment) VALUES (null, :customer_id, :payment, :delivery, :comment)", $fields);
        $order_id = $this->insert_id();
        foreach ($basket as $product_id => $order_quantity) {
            $fields = array($order_id, $product_id, $order_quantity, '0');
            $this->run("INSERT INTO customer_order_products (order_id, product_id, order_quantity, price) VALUES (?, ?, ?, ?)", $fields);
        }
    }

    public function basket(array $basket) {
        $customer_group_id = 1;

        $rows = array();
        foreach($basket as $product_id => $quantity) {
            $row = $this->get($product_id, $customer_group_id);
            $row['quantity'] = $quantity;
            $rows[] = $row;
        }
        return $rows;
    }

    private function get($id, $customer_group_id) {
        return $this->query_for_row("SELECT * FROM products p, product_customer_groups c WHERE p.id = c.product_id AND c.display = 1 AND p.id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }
}
