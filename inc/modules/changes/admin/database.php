<?php

class Changes_Database extends Database {
    public function last() {
        return $this->query("SELECT c.*, coalesce(e.first_name, '') name FROM changes c LEFT JOIN employees e ON e.id = c.employee_id WHERE time > now() - INTERVAL 30 DAY ORDER BY time DESC");
    }
}
