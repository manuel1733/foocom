<?php

class Employees_Database extends Database {

    public function is_valid($fields) {
        echo 'mail ' . $fields['mail'] . '<br>';
        echo 'password ' . $fields['password'];
        return $this->query_for_one("SELECT COUNT(*) FROM employees WHERE mail = :mail AND password = :password", $fields);
    }

    public function insert(array $fields) {
        $this->run("INSERT INTO employees (id, name, mail, password) VALUES (null, :name, :mail, :password)", $fields);
    }

    public function update(array $fields) {
        $this->run("UPDATE employees SET name = :name, mail = :mail WHERE id = :employee_id", $fields);
    }

    public function get($employee_id) {
        $fields = array('employee_id' => $employee_id);
        return $this->query_for_row("SELECT id, name, mail FROM employees WHERE id = :employee_id", $fields);
    }

    public function get_by_mail($mail) {
        $fields = array('mail' => $mail);
        return $this->query_for_row("SELECT id, name, mail FROM employees WHERE mail = :mail", $fields);
    }

    public function all() {
        return $this->query("SELECT id, name, mail FROM employees");
    }
}