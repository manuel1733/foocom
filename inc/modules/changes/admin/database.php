<?php

class Changes_Database extends Database {
    public function last() {
        return $this->query("SELECT * FROM changes WHERE time > now() - INTERVAL 30 DAY ORDER BY time DESC");
    }
}
