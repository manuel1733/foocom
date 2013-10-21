<?php

class Changes_Database extends Database {
    public function last() {
        return $this->query("SELECT * FROM changes WHERE time > now() - 30");
    }
}
