<?php

defined('admin') or die ('no direct access');

class Products_Groups extends Controller {
    private $db;
    private $fields;

    function Products_Groups() {
        $this->db = new Products_Database();
        $this->fields = array(
            'name' => '',
            'parent_id' => '',
        );
    }

    function handle(ORequest $request) {
        $id = $request->param_as_number(2);

        if ($request->is_post('products-groups')) {
            $fields = $request->populate($this->fields);
            if ($id == 0) {
                $id = $this->db->groups_insert($fields);
            } else {
                $this->db->groups_update($id, $fields);
            }
            $request->forward('products-groups-' . $id);
        } else {
            $template = new Template('products', 'groups');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->groups_get($id));
            }
            $template->set_ar('groups', $this->db->groups_all());
            $template->set_ar('groups_select', $this->db->groups_all($id));
            $template->display();
        }
    }
}
