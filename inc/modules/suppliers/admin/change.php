<?php

defined('admin') or die ('no direct access');

include 'db.php';

class Suppliers_Change extends Controller {
    private $db;
    private $fields;

    function Suppliers_Change() {
        $this->db = new Suppliers_Database();
        $this->fields = array(
            'name' => '',
            'addition' => '',
            'street' => '',
            'zipcode' => '',
            'city' => '',
            'tel' => '',
            'fax' => '',
            'mail' => '',
            'comment' => '',
            'country' => 1,
        );
    }

    function handle(Request $request) {
        $id = $request->param_as_number(2);
        if ($request->is_post('suppliers-change')) {
            $this->db->update($id, $request->populate($this->fields));
            $request->forward('suppliers-change-' . $id);
        } else {
            $fields = $this->db->get($id);
            $template = new Template('suppliers', 'change');
            $template->set('id', $id);
            $template->set_ar($fields);
            $template->set_ar('countries', $this->db->countries());
            $template->display();
        }
    }
}
