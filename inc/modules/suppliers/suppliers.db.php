<?php

defined('main') or die ('no direct access');

class Suppliers_Database {
    private $db;

    function Suppliers_Database(Database $db) {
        $this->db = $db;
    }

    function insert(array $fields) {
        $this->db->run("INSERT INTO users (id, name) VALUES (null, :name)", array('name' => $fields['name']));
        $user_id = $this->db->insert_id();
        $fields['user_id'] = $user_id;
        unset($fields['name']);
        $this->db->run("INSERT INTO suppliers
            (user_id, addition, street, zipcode, city, tel, fax, mail, comment, country)
            VALUES (:user_id, :addition, :street, :zipcode, :city, :tel, :fax, :mail, :comment, :country)",
            $fields);
        return $user_id;
    }

    function update($user_id, array $fields) {
        $this->db->run("UPDATE users SET name = :name WHERE id = :user_id", array('user_id' => $user_id, 'name' => $fields['name']));
        unset($fields['name']);
        $fields['user_id'] = $user_id;
        $this->db->run("UPDATE suppliers SET addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE user_id = :user_id", $fields);
    }

    function delete($user_id) {
        $fields = array('user_id' => $user_id);
        $this->db->run("DELETE FROM suppliers WHERE user_id = :user_id", $fields);
        $this->db->run("DELETE FROM users WHERE id = :user_id", $fields);
    }

    function get($user_id) {
        return $this->db->query_for_row("SELECT * FROM suppliers s, users u WHERE s.user_id = u.id AND u.id = :user_id", array('user_id' => $user_id));
    }

    function all_iterator() {
        return $this->db->query("SELECT s.user_id, u.name FROM suppliers s, users u WHERE s.user_id = u.id", array());
    }
}