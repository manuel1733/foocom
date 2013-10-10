<?php

include 'inc/modules/products/db.php';

class Products extends Controller {
    private $db;

    function Products() {
        $this->db = new Products_Database();
    }

    function handle(Request $request) {
        $id = $request->param_as_number(1);

        $template = new Template('products', 'products');

        if ($request->param(2) == 'groups') {
            $template->set_ar('products', $this->db->products_group($id));
        } elseif ($request->param(2) == 'allergens') {
            $template->set_ar('products', $this->db->products_allergen($id));
        } elseif ($request->param(2) == 'labels') {
            $template->set_ar('products', $this->db->products_label($id));
        } elseif ($request->param(2) == '') {
            $this->handle_product($id);
        }

        $template->display();
    }

    private function handle_product($id) {
        $template = new Template('products', 'product');
        $template->set_ar($this->db->get($id));
        $template->display();
    }
}
