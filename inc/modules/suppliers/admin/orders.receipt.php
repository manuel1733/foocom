<?php

defined('admin') or die ('no direct access');

class Suppliers_Orders_Receipt extends Controller {
    private $db;

    function Suppliers_Orders_Receipt() {
        $this->db = new Suppliers_Database();
    }

    function handle(ORequest $request) {

        if ($request->is_post('supplier-order-receipt')) {
            $this->handle_formular_submit($request);
        } else {
            $this->handle_formular_show($request);
        }
    }

    private function handle_formular_show(ORequest $request) {
        $id = $request->param_as_number(3);
        $template = new Template('suppliers', 'orders.receipt');
        $template->set('id', $id);

        $products = $this->db->order_products($id);
        foreach ($products as $key => $row) {
            $batches = $this->db->batches($id, $row['id']);
            if (!is_array($batches)) {
                $batches = array();
            }
            $batches[] = array('ib' => '0', 'order_quantity' => '0', 'best_before' => date('Y-m-d'), 'storage_yard_id' => '1');
            $row['batches'] = $batches;
            $products[$key] = $row;
        }

        $template->set_ar('storage_yards', $this->db->storage_yards());
        $template->set_ar('products', $products);
        $template->display();
    }

    private function handle_formular_submit(ORequest $request) {
        $id = $request->param_as_number(3);
        $order_quantities = $request->param('order_quantity');
        $storage_yards = $request->param('storage_yard');
        $best_befores = $request->param('best_before');
        foreach ($order_quantities as $product_id => $batches) {
            foreach ($batches as $batch_id => $order_quantity) {
                $storage_yard = $storage_yards[$product_id][$batch_id];
                $best_before = $best_befores[$product_id][$batch_id];
                if (empty($order_quantity) && !empty($batch_id)) {
                    $this->db->batch_delete($batch_id);
                }
                if (!empty($order_quantity) && !empty($batch_id)) {
                    $this->db->batch_update($batch_id, $order_quantity, $storage_yard, $best_before);
                }
                if (!empty($order_quantity) && empty($batch_id)) {
                    $this->db->batch_insert($id, $product_id, $order_quantity, $storage_yard, $best_before);
                }
            }
        }
        $request->forward('suppliers-orders-receipt-' . $id);
    }
}
