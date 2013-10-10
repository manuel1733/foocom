<?php

defined('admin') or die ('no direct access');

include 'inc/modules/producers/admin/db.php';

class Producers extends Controller {
    private $db;
    private $fields;

    function Producers() {
        $this->db = new Producers_Database();
        $this->fields = array(
            'name' => '',
        );
    }

    function handle(Request $request) {
        $id = $request->param_as_number(1);

        if ($request->is_post('producers')) {
            $fields = $request->populate($this->fields);
            if ($id == 0) {
                $id = $this->db->insert($fields);
            } else {
                $this->db->update($id, $fields);
            }
            $request->forward('producers-' . $id);
        } else {
            $template = new Template('producers', 'producers');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->get($id));
            }
            $template->set_ar('producers', $this->db->all());
            $template->display();
        }
    }
}
