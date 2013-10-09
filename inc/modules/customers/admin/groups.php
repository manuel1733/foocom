<?php

defined('admin') or die ('no direct access');

include 'db.php';

class Customers_Groups extends Controller {
    private $db;
    private $fields;

    function Customers_Groups() {
        $this->db = new Customers_Database();
        $this->fields = array(
            'name' => '',
            'discount' => '0',
        );
    }

    function handle(Request $request) {
        $id = $request->param_as_number(2);

        if ($request->is_post('customers-groups')) {
            $fields = $request->populate($this->fields);
            if ($id == 0) {
                $id = $this->db->groups_insert($fields);
            } else {
                $this->db->groups_update($id, $fields);
            }
            $request->forward('customers-groups-' . $id);
        } else {
            $template = new Template('customers', 'groups');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->groups_get($id));
            }
            $template->set_ar('groups', $this->db->groups_all());
            $template->display();
        }
    }
}
