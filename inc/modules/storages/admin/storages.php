<?php

class Storages extends Controller {
    private $db;

    function Storages() {
        $this->db = new Storages_Database();
    }

    function handle(ORequest $request) {
        if ($request->is_post('storages')) {
            $this->handle_formular_submit($request);
        } else {
            $template = new Template('storages', 'storages');
            $template->set_ar('storages', $this->db->storages());
            $template->display();
        }
    }

    private function handle_formular_submit(ORequest $request) {
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
        $request->forward('storages');
    }
}
