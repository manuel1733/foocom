<?php

defined('main') or die ('no direct access');

class Producers_Database {
    private $db;

    function Producers_Database(Database $db) {
        $this->db = $db;
    }

    function insert(array $fields) {
        $this->db->run("INSERT INTO producers (id, name) VALUES (null, :name)", $fields);
        return $this->db->insert_id();
    }

    function update($id, array $fields) {
        $fields['id'] = $id;
        $this->db->run("UPDATE producers SET name = :name WHERE id = :id", $fields);
    }

    function delete($id) {
        $this->db->run("DELETE FROM producers WHERE id = :id", array('id' => $id));
    }

    function get($id) {
        return $this->db->query_for_row("SELECT * FROM producers WHERE id = :id", array('id' => $id));
    }

    function all_iterator() {
        return $this->db->query("SELECT * FROM producers", array());
    }
}
