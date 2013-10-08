<?php

defined('admin') or die ('no direct access');

include 'db.php';

class Suppliers_Orders_Close extends Controller {
    private $db;

    function Suppliers_Orders_Close() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        $id = $request->param_as_number(3);
        if ($request->is_post('suppliers-orders-close')) {
            $supplier_id = $this->db->order_state($id, 1);
            $request->forward('suppliers-orders-' . $supplier_id);
        } else {
            $template = new Template('suppliers', 'orders.close');
            $template->set('id', $id);
            $template->display();
        }
    }
}
