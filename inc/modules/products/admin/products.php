<?php

defined('admin') or die ('no direct access');

include 'inc/modules/products/admin/db.php';

class Products extends Controller {
    protected $db;

    function Products() {
        $this->db = new Products_Database();
    }

    public function handle(Request $request) {
        if ($request->is_post('products-create')) {
            $id = $this->db->insert($request->populate(array('name' => '')));
            $request->forward('products-change' . $id);
        } else {
            $template = new Template('products', 'products');
            $template->set_ar('products', $this->db->all());
            $template->display();
        }
    }
}
