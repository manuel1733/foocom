<?php

$fields = array(
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

$id = $request->param_as_number(2);

if ($request->is_post()) {
    $sdb->update($id, $request->populate($fields));

    exit(0);
}

$fields = $sdb->get($id);

$template = new Template('suppliers/change');
$template->set('id', $id);
$template->set_ar($fields);
$template->set_ar('countries', $sdb->countries());
$template->out($design);
