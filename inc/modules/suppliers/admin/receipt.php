<?php

defined('admin') or die ('no direct access');

class Suppliers_Receipt extends Controller {
    private $db;

    function Suppliers_Receipt() {
        $this->db = new Suppliers_Database();
    }

    function handle(ORequest $request) {
        $tpl = new Template('suppliers',  'receipt');
        $tpl->set('orders', SupplierOrder::with('supplier')->where('state', '=', '1')->get()->toArray());
        $tpl->display();
    }
}
