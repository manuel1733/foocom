<?php

defined('admin') or die ('no direct access');

include 'inc/modules/products/admin/db.php';

class Products_Allergens extends Controller {
    private $db;
    private $fields;

    function Products_Allergens() {
        $this->db = new Products_Database();
        $this->fields = array(
            'name' => '',
        );
    }

    function handle(Request $request) {
        $id = $request->param_as_number(2);

        if ($request->is_post('products-allergens')) {
            $fields = $request->populate($this->fields);
            if ($id == 0) {
                $id = $this->db->allergens_insert($fields);
            } else {
                $this->db->allergens_update($id, $fields);
            }
            $request->forward('products-allergens-' . $id);
        } else {
            $template = new Template('products', 'allergens');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->allergens_get($id));
            }
            $template->set_ar('allergens', $this->db->allergens_all());
            $template->display();
        }
    }
}
