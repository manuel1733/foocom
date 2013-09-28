<?php

defined('main') or die ('no direct access');

include 'products.db.php';

$product_db = new Products_Database($db);

$design->header('Produkte');

$template = new Template('products/products');
$template->set('suppliers', '');
$template->set_option_list('suppliers', $product_db->suppliers());
$template->set('allergens', '');
$template->set_option_list('allergens', $product_db->allergens());
$template->set('labels', '');
$template->set_option_list('labels', $product_db->labels());
$template->out(0);
$template->out(2);
$template->out(4);

$design->footer();