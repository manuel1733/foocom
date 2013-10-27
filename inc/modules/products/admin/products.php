<?php

defined('admin') or die ('no direct access');

class Products extends Controller {
    protected $db;

    function Products() {
        $this->db = new Products_Database();
    }

    public function handle(Request $request) {
        if ($request->is_post('products-create')) {
            $product = new Product;
            $product->name = $request->param('name');
            $product->producer_id = 1;
            $product->save();
            $id = $product->id;
            $request->forward('products-change-' . $id);
        } else {
            $template = new Template('products', 'products');
            $template->set_ar('products', $this->db->all());
            $template->display();
        }
    }
}
