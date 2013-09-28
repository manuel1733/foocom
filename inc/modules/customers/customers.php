<?php

defined('main') or die ('no direct access');

include 'customers.db.php';

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

$customer_db = new Customers_Database($db);

if ($request->param(1) == 'groups') {
    include 'groups.php';
    exit(0);
}

$user_id = $request->param_as_number(1);

if ($request->is_post()) {
    $fields = $request->populate($fields);
    if ($user_id == 0) {
        $customer_db->insert($fields);
        header('location: index.php?customers-' . $user_id);
    } else {
        $customer_db->update($user_id, $fields);
        header('location: index.php?customers-' . $user_id);
    }
    exit(0);
} elseif (!empty($user_id)) {
    if ($request->param(2) == 'delete') {
        $customer_db->delete($user_id);
        header('location: index.php?customers');
    }

    $fields = $customer_db->get($user_id);
}

$design->header('Kunden');
$template = new Template('customers/customers');
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
foreach ($customer_db->all_iterator() as $row) {
    $template->set_ar_out($row, 4);
}
$template->out(5);
$design->footer();
