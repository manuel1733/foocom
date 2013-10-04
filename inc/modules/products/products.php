<?php

defined('main') or die ('no direct access');

include 'products.db.php';

class Products extends Controller {
    protected $db;

    function Products() {
        $this->db = new Products_Database();
    }

}

function identity($x) {
    return $x;
}

$pdb = new Products_Database();

switch ($request->param(1)) {
    case 'create' :
        identity(new Product_Creator())->handle($request);

        $id = $pdb->insert($request->populate(array('name' => '')));
        header('location: index.php?products-change-' . $id);
        break;
    case 'change' :
        include 'change.php';
        break;
    default:
        include 'overview.php';
}
