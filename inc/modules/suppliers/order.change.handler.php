<?php

$id = $request->param_as_number(3);


$template = new Template('suppliers/order_change');

if (0 == $sdb->order_product_count($id)) {
    $template->set_ar('products', $sdb->order_product_suggestion($id));
} else {
    $template->set_ar('products', $sdb->order_products($id));
}

$template->out($design);
