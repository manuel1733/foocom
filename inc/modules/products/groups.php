<?php

defined('main') or die ('no direct access');


$fields = array(
    'name' => '',
    'discount' => 0,
);

$id = $request->param_as_number(2);

if ($request->is_post()) {
    $fields = $request->populate($fields);
    if ($id == 0) {
        $id = $customer_db->insert_group($fields);
        header('location: index.php?customers-groups-' . $id);
    } else {
        $customer_db->update_group($id, $fields);
        header('location: index.php?customers-groups-' . $id);
    }
    exit(0);
} elseif (!empty($id)) {
    if ($request->param(3) == 'delete') {
        $customer_db->delete_group($id);
        header('location: index.php?customers-groups');
    }

    $fields = $customer_db->get_group($id);
}

$design->header('Kundengruppen');
$template = new Template('customers/groups');
$template->set('id', $id);
$template->out(0);
if ($id == 0) {
    $template->out(1);
} else {
    $template->out(2);
}
$template->set_ar($fields);
$template->out(3);
foreach ($customer_db->all_groups_iterator() as $row) {
    $template->set_ar_out($row, 4);
}
$template->out(5);
$design->footer();
