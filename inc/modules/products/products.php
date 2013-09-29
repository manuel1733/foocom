<?php

defined('main') or die ('no direct access');

include 'products.db.php';

$pdb = new Products_Database($db);

switch ($request->param(1)) {
    case 'create' :
        $id = $pdb->insert($request->populate(array('name' => '')));
        header('location: index.php?products-change-' . $id);
        break;
    case 'change' :
        include 'change.php';
        break;
    default:
        include 'overview.php';
}

exit(0);

$fields = array(
    'name' => '',
    'ean' => '',
    'description' => '',
    'min_stock' => '',
    'order_quantity' => '',
    'food_value' => '',
    'ingredients' => '',
    'producer' => '',

);


$design->header('Produkte');
$id = $request->param(1);

$template = new Template('products/products');
$template->set_ar($fields);
$template->set('suppliers', '');
$template->set_option_list('suppliers', $product_db->suppliers());
$template->set('allergens', '');
$template->set_option_list('allergens', $product_db->allergens());
$template->set('labels', '');
$template->set_option_list('labels', $product_db->labels());
$template->set('product_groups', '');
$template->set_option_list('product_groups', $product_db->product_groups());
$template->set('producers', '');
$template->set_option_list('producers', $product_db->producers());
$template->out(0);
foreach ($product_db->labels_for($id) as $row) {
    $template->set_ar_out($row, 1);
}
$template->out(2);
foreach ($product_db->product_groups_for($id) as $row) {
    $template->set_ar_out($row, 3);
}
$template->out(4);
foreach ($product_db->allergens_for($id) as $row) {
    $template->set_ar_out($row, 5);
}
$template->out(6);
foreach ($product_db->customer_groups_for($id) as $row) {
    $template->set_ar_out($row, 7);
}
$template->out(8);
foreach ($product_db->suppliers_for($id) as $row) {
    $template->set_ar_out($row, 9);
}
$template->out(10);

$design->footer();

