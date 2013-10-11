<?php

defined('admin') or die ('no direct access');

class Customers_Change extends Controller {
    private $db;
    private $fields;

    function Customers_Change() {
        $this->db = new Customers_Database();
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
        if ($request->is_post('customers-change')) {
            $this->db->update($id, $request->populate($this->fields));
            $request->forward('customers-change-' . $id);
        } else {
            $fields = $this->db->get($id);
            $template = new Template('customers', 'change');
            $template->set('id', $id);
            $template->set_ar($fields);
            $template->set_ar('countries', $this->db->countries());
            $template->display();
        }
    }
}
