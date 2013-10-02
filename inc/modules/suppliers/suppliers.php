<?php

defined('main') or die ('no direct access');

include 'suppliers.db.php';

$sdb = new Suppliers_Database();

switch ($request->param(1)) {
    case 'create' :
        $id = $sdb->insert($request->populate(array('name' => '')));
        header('location: index.php?suppliers-change-' . $id);
        break;
    case 'delete' :
        $sdb->delete($request->param_as_number(2));
        header('location: index.php?suppliers');
        break;
    case 'change' :
        include 'change.php';
        break;
    default:
        include 'overview.php';
}
