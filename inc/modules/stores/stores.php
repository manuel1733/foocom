<?php

include 'stores.db.php';

class Stores extends Controller {
    private $db;

    function Stores() {
        $this->db = new Stores_Database();
    }

    function handle(Request $request) {
        // TODO: add check to prevent cross site request forgery.
        if ($request->is_post()) {
            $this->handle_formular_submit($request);
        } else {
            $template = new Template('stores/stores');
            $template->set_ar('stores', $this->db->stores());
            $template->display();
        }
    }

    private function handle_formular_submit(Request $request) {
        if ($request->param_exists('new_name')) {
            $this->db->insert($request->populate(array('new_name' => '')));
        }

        if ($request->param_exists('name')) {
            foreach ($request->param('name') as $id => $name) {
                $this->db->update($id, $name);

                $new_number = $request->param('new_number');
                $number = $request->param('number');
                if (!empty($new_number[$id])) {
                    $this->db->insert_yard($id, $new_number[$id]);
                }

                if (!empty($number[$id])) {
                    foreach ($number[$id] as $yid => $ynumber) {
                        $this->db->update_yard($yid, $ynumber);
                    }
                }
            }
        }
    }
}
