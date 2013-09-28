<?php

defined('main') or die ('no direct access');

include 'suppliers.db.php';

$countries = array(
    1 => 'Switzerland',
    2 => 'Germany',
    3 => 'Austria',
);

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

$supplier_db = new Suppliers_Database($db);

$user_id = $request->param_as_number(1);

if ($request->param(2) == 'products') {
    include 'products.php';
    exit(0);
}

if ($request->is_post()) {
    $fields = $request->populate($fields);
    if ($user_id == 0) {
        $supplier_db->insert($fields);
        header('location: index.php?suppliers-' . $user_id);
    } else {
        $supplier_db->update($user_id, $fields);
        header('location: index.php?suppliers-' . $user_id);
    }
    exit(0);
} elseif (!empty($user_id)) {
    if ($request->param(2) == 'delete') {
        $supplier_db->delete($user_id);
        header('location: index.php?suppliers');
    }

    $fields = $supplier_db->get($user_id);
}

$design->header('Lieferanten');
$template = new Template('suppliers/suppliers');
$template->set('user_id', $user_id);
$template->out(0);
if ($user_id == 0) {
    $template->out(1);
} else {
    $template->out(2);
}
$template->set_ar($fields);
$template->set_option_list('country', $countries);
$template->out(3);
foreach ($supplier_db->all_iterator() as $row) {
    $template->set_ar_out($row, 4);
}
$template->out(5);
$design->footer();
