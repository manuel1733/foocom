<?php

defined('admin') or die ('no direct access');

class Suppliers_Orders_Change extends Controller {
    private $db;

    function Suppliers_Orders_Change() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        if ($request->is_post('supplier-order-change')) {
            $this->handle_formular_submit($request);
        } else {
            $this->handle_formular_show($request);
        }
    }

    private function handle_formular_show(Request $request) {
        $id = $request->param_as_number(3);
        $template = new Template('suppliers', 'orders.change');
        if (0 == $this->db->order_product_count($id)) {
            $template->set('id', $id);
            $template->set('product_search', 0);
            $template->set_ar('products', $this->db->order_suggestion($id));
        } else {
            $template->set('id', $id);
            $template->set('product_search', 1);
            $template->set_ar('products', $this->db->order_products($id));
        }
        $template->display();
    }

    private function handle_formular_submit(Request $request) {
        $order_quantities = $request->param('order_quantity');
        if (empty($order_quantities) || !is_array($order_quantities)) {
            return;
        }

        $id = $request->param_as_number(3);
        foreach($order_quantities as $product_id => $order_quantity) {
            if (empty($order_quantity)) {
                $this->db->order_delete_product($id, $product_id);
            } else {
                if ($this->db->order_product_exists($id, $product_id)) {
                    $this->db->order_update_product($id, $product_id, $order_quantity);
                } else {
                    $this->db->order_add_product($id, $product_id, $order_quantity);
                }
            }
        }
        $request->forward('suppliers-orders-change-' . $id);
    }
}
