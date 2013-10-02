<?php

function handle_select($pdb, Request $request, $iterator, $id, $name) {
    if ($request->param_exists($name)) {
        foreach($iterator as $row) {
            $is_selected = in_array($row['id'], $request->param($name));
            $was_selected = $row['selected'] != null;
            if ($was_selected && !$is_selected) {
                $pdb->delete_select($name, $id, $row['id']);
            }
            if (!$was_selected && $is_selected) {
                $pdb->add_select($name, $id, $row['id']);
            }
        }
    }
}

$fields = array(
    'name' => '',
    'ean' => '',
    'description' => '',
    'min_stock' => '',
    'order_quantity' => '',
    'food_value' => '',
    'ingredients' => '',
    'producer_id' => '',
);

$id = $request->param(2);

if ($request->is_post()) {
    $fields = $request->populate($fields);
    $pdb->update($id, $fields);

    handle_select($pdb, $request, $pdb->labels_for($id), $id, 'labels');
    handle_select($pdb, $request, $pdb->product_groups_for($id), $id, 'product_groups');
    handle_select($pdb, $request, $pdb->allergens_for($id), $id, 'allergens');

    $customer_price = $request->param('customer_price');
    $customer_display = $request->param('customer_display');
    foreach($request->param('customer_groups') as $gid) {
        $price = $customer_price[$gid];
        $display = empty($customer_display[$gid]) ? 0 : 1;
        $pdb->update_customer_group($id, $gid, $price, $display);
    }

    if ($request->param_exists('supplier_add')) {
        $pdb->add_supplier($id, $request->param('supplier_add'));
    }

    $supplier_product_number = $request->param('supplier_product_number');
    $supplier_purchase_price = $request->param('supplier_purchase_price');
    $supplier_order_quantity = $request->param('supplier_order_quantity');
    $supplier_delete = $request->param('supplier_delete');
    if ($request->param_exists('suppliers')) {
        foreach($request->param('suppliers') as $i => $sid) {
            if (!empty($supplier_delete[$sid])) {
                $pdb->delete_supplier($id, $sid);
            } else {
                $product_number = $supplier_product_number[$i];
                $purchase_price = $supplier_purchase_price[$i];
                $order_quantity = $supplier_order_quantity[$i];
                $pdb->update_supplier($id, $sid, $product_number, $purchase_price, $order_quantity);
            }
        }
    }

    // header('location: index.php?products-change-' . $id);
    exit(0);
}

$template = new Template('products/change');
$template->set_ar($fields);
$template->set_row_iterator('allergens', $pdb->allergens_for($id));
$template->set_row_iterator('product_groups', $pdb->product_groups_for($id));
$template->set_row_iterator('labels', $pdb->labels_for($id));
$template->set_row_iterator('producers', $pdb->producers());
$template->set_row_iterator('customer_groups', $pdb->customer_groups_for($id));
$template->set_row_iterator('suppliers', $pdb->suppliers_for($id));
$template->set_row_iterator('available_suppliers', $pdb->suppliers_not($id));
$template->out($design);
