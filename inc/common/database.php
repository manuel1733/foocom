<?php

defined ('main') or die ('no direct access');

class Database {

    private $db;

    public function Database() {
        $this->db = new PDO('mysql:host=localhost;dbname=foocom', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function run($query, array $fields) {
        $statement = $this->prepare($query, $fields);
        $statement->execute();
        $statement->closeCursor();
    }

    private function prepare($query, array $fields) {
        $statement = $this->db->prepare($query);
        foreach ($fields as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        return $statement;
    }

    function insert_id() {
        return $this->db->lastInsertId();
    }

    function query_for_row($query, array $fields) {
        $statement = $this->prepare($query, $fields);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $row;
    }

    function query($sql, array $fields) {
        $statement = $this->prepare($sql, $fields);
        $statement->execute();

        return new Database_Result($statement);
    }
}

class Database_Result implements Iterator {
    private $statement;
    private $row;

    function Database_Result(PDOStatement $statement) {
        $this->statement = $statement;
    }

    function rewind() {
        $this->next();
    }

    function current() {
        return $this->row;
    }

    function key() {
        return 0;
    }

    function next() {
        $this->row = $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    function valid() {
        return $this->row != null;
    }
}
