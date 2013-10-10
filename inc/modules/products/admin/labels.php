<?php

defined('admin') or die ('no direct access');

include 'inc/modules/products/admin/db.php';

class Products_Labels extends Controller {
    private $db;
    private $fields;

    function Products_Labels() {
        $this->db = new Products_Database();
        $this->fields = array(
            'name' => '',
        );
    }

    function handle(Request $request) {
        $id = $request->param_as_number(2);

        if ($request->is_post('products-labels')) {
            $fields = $request->populate($this->fields);
            if ($id == 0) {
                $id = $this->db->labels_insert($fields);
            } else {
                $this->db->labels_update($id, $fields);
            }
            $request->forward('products-labels-' . $id);
        } else {
            $template = new Template('products', 'labels');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->labels_get($id));
            }
            $template->set_ar('labels', $this->db->labels_all());
            $template->display();
        }
    }
}
