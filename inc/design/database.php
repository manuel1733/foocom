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

    public function basket(array $basket) {
        $customer_group_id = 1;

        $rows = array();
        foreach($basket as $product_id => $quantity) {
            $row = $this->get($product_id, $customer_group_id);
            $row['quantity'] = $quantity;
            $rows[] = $row;
        }
        return $rows;
    }

    private function get($id, $customer_group_id) {
        return $this->query_for_row("SELECT * FROM products p, product_customer_groups c WHERE p.id = c.product_id AND c.display = 1 AND p.id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }
}
