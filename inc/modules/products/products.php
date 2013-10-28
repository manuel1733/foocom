<?php

class Products extends Controller {
    private $db;

    function Products() {
        $this->db = new Products_Database();
    }

    function handle(ORequest $request) {
        $id = $request->param_as_number(1);

        $template = new Template('products', 'products');

        $customer_group_id = 1;

        if ($request->param(2) == 'groups') {
            $template->set_ar('products', $this->db->products_group($id, $customer_group_id));
        } elseif ($request->param(2) == 'allergens') {
            $template->set_ar('products', $this->db->products_allergen($id, $customer_group_id));
        } elseif ($request->param(2) == 'labels') {
            $template->set_ar('products', $this->db->products_label($id, $customer_group_id));
        } elseif ($request->param(2) == '') {
            $this->handle_product($id, $customer_group_id);
            return;
        }

        $template->display();
    }

    private function handle_product($id, $customer_group_id) {
        $template = new Template('products', 'product');
        $template->set_ar($this->db->get($id, $customer_group_id));
        $template->display();
    }
}
