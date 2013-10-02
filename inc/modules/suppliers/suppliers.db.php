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
}
