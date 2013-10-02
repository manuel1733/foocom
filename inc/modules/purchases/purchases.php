<?php

defined('main') or die ('no direct access');

include 'purchases.db.php';

$pdb = new Purchases_Database();

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
