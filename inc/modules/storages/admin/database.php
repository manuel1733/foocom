<?php

class Storages_Database extends Database {

    function insert(array $fields) {
        $this->run("INSERT INTO storages (id, name) VALUES (null, :new_name)", $fields);
    }

    function update($id, $name) {
        $this->run("UPDATE storages SET name = :name WHERE id = :id", array('id' => $id, 'name' => $name));
    }

    function insert_yard($store_id, $number) {
        $fields = array('store_id' => $store_id, 'number' => $number);
        $this->run("INSERT INTO storage_yards (id, store_id, number) VALUES (null, :store_id, :number)", $fields);
    }

    function update_yard($id, $number) {
        $fields = array('id' => $id, 'number' => $number);
        $this->run("UPDATE storage_yards SET number = :number WHERE id = :id", $fields);
    }

    function storages() {
        $stores = array();
        foreach ($this->query("SELECT * FROM storages") as $r) {
            $r['yards'] = $this->query("SELECT * FROM storage_yards WHERE storage_id = :storage_id", array('storage_id' => $r['id']));
            $stores[] = $r;
        }
        return $stores;
    }
}
