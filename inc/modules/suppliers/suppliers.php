<?php

defined('main') or die ('no direct access');

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
    'country' => 2,
);

$user_id = $request->param_as_number(1);
if ($request->is_post()) {
    $fields = $request->populate($fields);
    if ($user_id == 0) {
        $db->run("INSERT INTO users (id, name) VALUES (null, :name)", array('name' => $fields['name']));
        $user_id = $db->insert_id();
        $fields['user_id'] = $user_id;
        unset($fields['name']);
        $db->run("INSERT INTO suppliers
            (user_id, addition, street, zipcode, city, tel, fax, mail, comment, country)
            VALUES (:user_id, :addition, :street, :zipcode, :city, :tel, :fax, :mail, :comment, :country)",
            $fields);
        header('location: index.php?suppliers-' . $user_id);
    } else {
        $db->run("UPDATE users SET name = :name WHERE id = :user_id", array('user_id' => $user_id, 'name' => $fields['name']));
        unset($fields['name']);
        $fields['user_id'] = $user_id;
        $db->run("UPDATE suppliers SET addition = :addition, street = :street, zipcode = :zipcode, city = :city, tel = :tel, fax = :fax, mail = :mail, comment = :comment, country = :country WHERE user_id = :user_id", $fields);
        header('location: index.php?suppliers-' . $user_id);
    }
    exit(0);
} elseif (!empty($user_id)) {
    if ($request->param(2) == 'delete') {
        $fields = array('user_id' => $user_id);
        $db->run("DELETE FROM suppliers WHERE user_id = :user_id", $fields);
        $db->run("DELETE FROM users WHERE id = :user_id", $fields);
        header('location: index.php?suppliers');
    }

    $fields = $db->query_for_row("SELECT * FROM suppliers s, users u WHERE s.user_id = u.id AND u.id = :user_id", array('user_id' => $user_id));
}

// VIEW
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
$row_iterator = $db->query("SELECT s.user_id, u.name FROM suppliers s, users u WHERE s.user_id = u.id", array());
foreach ($row_iterator as $row) {
    $template->set_ar_out($row, 4);
}
$template->out(5);
$design->footer();
