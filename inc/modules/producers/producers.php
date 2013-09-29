<?php

defined('main') or die ('no direct access');

include 'producers.db.php';

$fields = array(
    'name' => '',
);

$id = $request->param_as_number(1);
$db = new Producers_Database($db);

if ($request->is_post()) {
    $fields = $request->populate($fields);
    if ($id == 0) {
        $id = $db->insert($fields);
        header('location: index.php?producers-' . $id);
    } else {
        $db->update($id, $fields);
        header('location: index.php?producers-' . $id);
    }
    exit(0);
} elseif (!empty($id)) {
    if ($request->param(3) == 'delete') {
        $db->delete($id);
        header('location: index.php?producers');
    }

    $fields = $db->get($id);
}

$design->header('Hersteller');
$template = new Template('producers/producers');
$template->set('id', $id);
$template->out(0);
if ($id == 0) {
    $template->out(1);
} else {
    $template->out(2);
}
$template->set_ar($fields);
$template->out(3);
foreach ($db->all_iterator() as $row) {
    $template->set_ar_out($row, 4);
}
$template->out(5);
$design->footer();
