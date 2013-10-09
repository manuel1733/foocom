<?php

defined('admin') or die ('no direct access');

class Producers_Database extends Database {

    function insert(array $fields) {
        $this->run("INSERT INTO producers (id, name) VALUES (null, :name)", $fields);
        return $this->insert_id();
    }

    function update($id, array $fields) {
        $fields['id'] = $id;
        $this->run("UPDATE producers SET name = :name WHERE id = :id", $fields);
    }

    function delete($id) {
        $this->run("DELETE FROM producers WHERE id = :id", array('id' => $id));
    }

    function get($id) {
        return $this->query_for_row("SELECT * FROM producers WHERE id = :id", array('id' => $id));
    }

    function all() {
        return $this->query("SELECT * FROM producers", array());
    }
}
