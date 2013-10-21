<?php

class Employees_Database extends Database {

    public function is_valid($fields) {
        return $this->query_for_one("SELECT COUNT(*) FROM employees WHERE mail = :mail AND password = :password", $fields);
    }

    public function insert(array $fields) {
        $this->run("INSERT INTO employees (id, name, mail, password, role) VALUES (null, :name, :mail, :password, :role)", $fields);
    }

    public function update(array $fields) {
        $this->run("UPDATE employees SET name = :name, mail = :mail, role = :role WHERE id = :employee_id", $fields);
    }

    public function get($employee_id) {
        $fields = array('employee_id' => $employee_id);
        return $this->query_for_row("SELECT id, name, mail, role FROM employees WHERE id = :employee_id", $fields);
    }

    public function get_by_mail($mail) {
        $fields = array('mail' => $mail);
        return $this->query_for_row("SELECT id, name, mail, role FROM employees WHERE mail = :mail", $fields);
    }

    public function all() {
        return $this->query("SELECT id, name, mail, role FROM employees");
    }

    // Roles

    public function roles_all() {
        return $this->query("SELECT DISTINCT role FROM employee_roles ORDER BY role");
    }

    public function roles_all_options() {
        return $this->query("SELECT DISTINCT role id, role name FROM employee_roles ORDER BY role");
    }

    public function roles_all_paths() {
        return $this->query("SELECT p.path, r.role, coalesce(j.role, '0') checked FROM (SELECT * FROM employee_roles WHERE role = 'Admin') p INNER JOIN (SELECT DISTINCT role FROM employee_roles WHERE role != 'Admin') r LEFT JOIN employee_roles j ON p.path = j.path AND r.role = j.role ORDER BY p.path, r.role");
    }

    public function roles_insert($path, $role) {
        $this->run("INSERT INTO employee_roles VALUES (?, ?)", array($role, $path));
    }

    public function roles_delete($path, $role) {
        $this->run("DELETE FROM employee_roles WHERE role = ? AND path = ?", array($role, $path));
    }
}
