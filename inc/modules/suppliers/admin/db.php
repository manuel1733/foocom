<?php

defined('admin') or die ('no direct access');

class Suppliers_Database extends Database {

    function insert(array $fields) {
        $this->run("INSERT INTO suppliers (id, name) VALUES (null, :name)", $fields);
        return $this->insert_id();
    }

    function update($id, array $fields) {
        $fields['id'] = $id;
        $this->run("UPDATE suppliers SET name = :name, addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE id = :id", $fields);
    }

    function delete($user_id) {
        $fields = array('user_id' => $user_id);
        $this->run("DELETE FROM suppliers WHERE user_id = :user_id", $fields);
        $this->run("DELETE FROM users WHERE id = :user_id", $fields);
    }

    function get($id) {
        return $this->query_for_row("SELECT * FROM suppliers WHERE id = :id", array('id' => $id));
    }

    function all() {
        return $this->query("SELECT id, name FROM suppliers");
    }

    function all_orders($supplier_id) {
        $fields = array('supplier_id' => $supplier_id);
        return $this->query("SELECT id, state FROM supplier_orders WHERE supplier_id = :supplier_id ORDER BY id DESC", $fields);
    }

    function countries() {
        return $this->query("SELECT * FROM countries");
    }

    function create_order($supplier_id) {
        $fields = array('supplier_id' => $supplier_id);
        $this->run("INSERT INTO supplier_orders (id, supplier_id) VALUES (null, :supplier_id)", $fields);
        return $this->insert_id();
    }

    function order_supplier($order_id) {
        $fields = array('order_id' => $order_id);
        return $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
    }

    function order_product_count($order_id) {
        $fields = array('order_id' => $order_id);
        return $this->query_for_one("SELECT COUNT(*) FROM supplier_order_products WHERE order_id = :order_id", $fields);
    }

    function order_suggestion($order_id) {
        $fields = array('order_id' => $order_id);
        $supplier_id = $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
        $fields = array('supplier_id' => $supplier_id);
        return $this->query("SELECT
                p.id,
                p.name,
                p.order_quantity,
                p.min_stock,
                ps.product_number,
                ps.purchase_price,
                ps.order_quantity as supplier_order_quantity,
                COALESCE(b.stock_amount, 0) as stock_amount,
                GREATEST(p.order_quantity, ps.order_quantity, p.min_stock - COALESCE(b.stock_amount, 0)) as order_amount
            FROM product_suppliers ps
                INNER JOIN products p ON p.id = ps.product_id
                LEFT JOIN (SELECT product_id, SUM(storage_quantity) stock_amount FROM batches GROUP BY product_id) b ON p.id = b.product_id
            WHERE supplier_id = :supplier_id
              AND p.min_stock > 0
              AND COALESCE(b.stock_amount, 0) < p.min_stock
            ORDER BY p.id DESC", $fields);
    }

    function order_products($order_id) {
        $fields = array('order_id' => $order_id);
        return $this->query("SELECT
                p.id,
                p.name,
                p.order_quantity,
                p.min_stock,
                ps.product_number,
                ps.purchase_price,
                ps.order_quantity as supplier_order_quantity,
                COALESCE(b.stock_amount, 0) as stock_amount,
                sop.order_quantity as order_amount
            FROM supplier_order_products sop
                INNER JOIN supplier_orders sp ON sp.id = sop.order_id
                INNER JOIN product_suppliers ps ON ps.product_id = sop.product_id AND ps.supplier_id = sp.supplier_id
                INNER JOIN products p ON p.id = sop.product_id
                LEFT JOIN (SELECT product_id, SUM(storage_quantity) stock_amount FROM batches GROUP BY product_id) b ON p.id = b.product_id
            WHERE sop.order_id = :order_id
            ORDER BY p.id DESC", $fields);
    }

    function order_add_product($order_id, $product_id, $order_quantity) {
        $fields = array('order_id' => $order_id);
        $supplier_id = $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
        $fields = array('supplier_id' => $supplier_id, 'product_id' => $product_id);
        $purchase_price = $this->query_for_one("SELECT purchase_price FROM product_suppliers WHERE product_id = :product_id AND supplier_id = :supplier_id", $fields);
        $fields = array('order_id' => $order_id, 'product_id' => $product_id, 'order_quantity' => $order_quantity, 'purchase_price' => $purchase_price);
        $this->run("INSERT INTO supplier_order_products (order_id, product_id, order_quantity, purchase_price) VALUES (:order_id, :product_id, :order_quantity, :purchase_price)", $fields);
    }

    function order_delete_product($order_id, $product_id) {
        $fields = array('order_id' => $order_id, 'product_id' => $product_id);
        $this->run("DELETE FROM supplier_order_products WHERE order_id = :order_id AND product_id = :product_id", $fields);
    }

    function order_product_exists($order_id, $product_id) {
        $fields = array('order_id' => $order_id, 'product_id' => $product_id);
        return $this->query_for_one("SELECT COUNT(*) FROM supplier_order_products WHERE order_id = :order_id AND product_id = :product_id", $fields);
    }

    function order_update_product($order_id, $product, $order_quantity) {
        $fields = array('order_id' => $order_id);
        $supplier_id = $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
        $fields = array('supplier_id' => $supplier_id, 'product_id' => $product_id);
        $purchase_price = $this->query_for_one("SELECT purchase_price FROM product_suppliers WHERE product_id = :product_id AND supplier_id = :supplier_id", $fields);
        $fields = array('order_id' => $order_id, 'product_id' => $product_id, 'order_quantity' => $order_quantity, 'purchase_price' => $purchase_price);
        $this->run("UPDATE supplier_order_products SET order_quantity = :order_quantity, purchase_price = :purchase_price WHERE order_id = :order_id AND product_id = :product_id", $fields);
    }

    function order_state($order_id, $new_state) {
        $fields = array('order_id' => $order_id);
        $supplier_id = $this->query_for_one("SELECT supplier_id FROM supplier_orders WHERE id = :order_id", $fields);
        $fields['state'] = $new_state;
        $this->run("UPDATE supplier_orders SET state = :state WHERE id = :order_id", $fields);
        return $supplier_id;
    }

    function storage_yards() {
        return $this->query("SELECT id, number name FROM storage_yards ORDER BY number");
    }

    function batches($order_id, $product_id) {
        $fields = array('order_id' => $order_id, 'product_id' => $product_id);
        return $this->query("SELECT b.id ib, b.*, y.* FROM batches b, storage_yard_batches y WHERE b.id = y.batch_id AND order_id = :order_id AND product_id = :product_id", $fields);
    }

    function batch_delete($batch_id) {
        $this->batch_delete_storage_yard($batch_id);
        $fields = array('batch_id' => $batch_id);
        $this->run("DELETE FROM batches WHERE id = :batch_id", $fields);
    }

    function batch_update($batch_id, $order_quantity, $storage_yard, $best_before) {
        $this->batch_delete_storage_yard($batch_id);
        $fields = array('batch_id' => $batch_id, 'storage_yard_id' => $storage_yard);
        $this->run("INSERT INTO storage_yard_batches VALUES (:storage_yard_id, :batch_id)", $fields);
        $fields = array('batch_id' => $batch_id, 'order_quantity' => $order_quantity, 'best_before' => $best_before, 'storage_quantity' => $order_quantity);
        $this->run("UPDATE batches SET order_quantity = :order_quantity, best_before = :best_before, storage_quantity = :storage_quantity WHERE id = :batch_id", $fields);
    }

    function batch_insert($order_id, $product_id, $order_quantity, $storage_yard, $best_before) {
        $fields = array('order_id' => $order_id, 'product_id' => $product_id, 'order_quantity' => $order_quantity, 'best_before' => $best_before, 'storage_quantity' => $order_quantity);
        $this->run("INSERT INTO batches (id, order_id, product_id, best_before, order_quantity, storage_quantity) VALUES (null, :order_id, :product_id, :best_before, :order_quantity, :storage_quantity)", $fields);
        $batch_id = $this->insert_id();
        $this->batch_insert_storage_yard($batch_id, $storage_yard);
    }

    private function batch_delete_storage_yard($batch_id) {
        $fields = array('batch_id' => $batch_id);
        $this->run("DELETE FROM storage_yard_batches WHERE batch_id = :batch_id", $fields);
    }

    private function batch_insert_storage_yard($batch_id, $storage_yard_id) {
        $fields = array('batch_id' => $batch_id, 'storage_yard_id' => $storage_yard_id);
        $this->run("INSERT INTO storage_yard_batches VALUES (:storage_yard_id, :batch_id)", $fields);
    }
}
