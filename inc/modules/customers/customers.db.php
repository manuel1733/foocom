<?php

defined('main') or die ('no direct access');

class Customers_Database {
    private $db;

    function customers_Database(Database $db) {
        $this->db = $db;
    }

    function insert(array $fields) {
        $this->db->run("INSERT INTO users (id, name) VALUES (null, :name)", array('name' => $fields['name']));
        $user_id = $this->db->insert_id();
        $fields['user_id'] = $user_id;
        unset($fields['name']);
        $this->db->run("INSERT INTO customers
            (user_id, addition, street, zipcode, city, tel, fax, mail, comment, country)
            VALUES (:user_id, :addition, :street, :zipcode, :city, :tel, :fax, :mail, :comment, :country)",
            $fields);
        return $user_id;
    }

    function update($user_id, array $fields) {
        $this->db->run("UPDATE users SET name = :name WHERE id = :user_id", array('user_id' => $user_id, 'name' => $fields['name']));
        unset($fields['name']);
        $fields['user_id'] = $user_id;
        $this->db->run("UPDATE customers SET addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE user_id = :user_id", $fields);
    }

    function delete($user_id) {
        $fields = array('user_id' => $user_id);
        $this->db->run("DELETE FROM customers WHERE user_id = :user_id", $fields);
        $this->db->run("DELETE FROM users WHERE id = :user_id", $fields);
    }

    function get($user_id) {
        return $this->db->query_for_row("SELECT * FROM customers s, users u WHERE s.user_id = u.id AND u.id = :user_id", array('user_id' => $user_id));
    }

    function all_iterator() {
        return $this->db->query("SELECT s.user_id, u.name FROM customers s, users u WHERE s.user_id = u.id", array());
    }

    function insert_group(array $fields) {
        $this->db->run("INSERT INTO customer_groups (id, name, discount) VALUES (null, :name, :discount)", $fields);
        return $this->db->insert_id();
    }

    function update_group($id, array $fields) {
        $fields['id'] = $id;
        $this->db->run("UPDATE customer_groups SET name = :name, discount = :discount WHERE id = :id", $fields);
    }

    function delete_group($id) {
        $this->db->run("DELETE FROM customer_groups WHERE id = :id", array('id' => $id));
    }

    function get_group($id) {
        return $this->db->query_for_row("SELECT * FROM customer_groups WHERE id = :id", array('id' => $id));
    }

    function all_groups_iterator() {
        return $this->db->query("SELECT * FROM customer_groups", array());
    }
}
