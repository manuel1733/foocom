<?php

include 'stores.db.php';

$sdb = new Stores_Database();

if ($request->is_post()) {

    if ($request->param_exists('new_name')) {
        $sdb->insert($request->populate(array('new_name' => '')));
    }

    if ($request->param_exists('name')) {
        foreach ($request->param('name') as $id => $name) {
            $sdb->update($id, $name);

            $new_number = $request->param('new_number');
            $number = $request->param('number');
            if (!empty($new_number[$id])) {
                $sdb->insert_yard($id, $new_number[$id]);
            }

            if (!empty($number[$id])) {
                foreach ($number[$id] as $yid => $ynumber) {
                    $sdb->update_yard($yid, $ynumber);
                }

            }
        }
    }


    exit(0);
}


$template = new Template('stores/stores');

$template->set_ar('stores', $sdb->stores());

$template->out($design);

