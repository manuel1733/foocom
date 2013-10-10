<?php

class Design_Database extends Database {

    public function allergens() {
        return $this->query("SELECT * FROM allergens");
    }

    public function labels() {
        return $this->query("SELECT * FROM labels");
    }

    public function product_groups() {
        return $this->product_groups_children(0);
    }

    private function product_groups_children($id) {
        $rows = array();
        $i = 0;
        foreach ($this->query("SELECT * FROM product_groups WHERE parent_id = ?", array($id)) as $r) {
            $rows[$i++] = $r;
            $children = $this->product_groups_children($r['id']);
            if (count($children) > 0) {
                $rows[$i++] = $children;
            }
        }
        return $rows;
    }
}
