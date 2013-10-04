<?php

include 'stores.db.php';

class Stores_Handler extends Controller {
    private $db;

    function Stores_Handler() {
        $this->db = new Stores_Database();
    }

    function handle(Request $request) {
        // TODO: add check to prevent cross site request forgery.
        if (!$request->is_post()) {
            return;
        }
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
