<?php

class Products_Database extends Database {

    public function products_group($id, $customer_group_id) {
        return $this->query("SELECT * FROM products p, product_product_groups g, product_customer_groups c WHERE p.id = g.product_group_id AND p.id = c.product_id AND c.display = 1 AND g.product_group_id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }

    public function products_allergen($id, $customer_group_id) {
        return $this->query("SELECT * FROM products p, product_allergens a, product_customer_groups c WHERE p.id = a.product_id AND p.id = c.product_id AND c.display = 1 AND a.allergen_id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }

    public function products_label($id, $customer_group_id) {
        return $this->query("SELECT * FROM products p, product_labels l, product_customer_groups c WHERE p.id = l.product_id AND p.id = c.product_id AND c.display = 1 AND l.label_id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }

    function get($id, $customer_group_id) {
        return $this->query_for_row("SELECT * FROM products p, product_customer_groups c WHERE p.id = c.product_id AND c.display = 1 AND p.id = ? AND c.customer_group_id = ?", array($id, $customer_group_id));
    }

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
