<?php

defined('admin') or die ('no direct access');

include 'db.php';
include 'fpdf/fpdf.php';

class Suppliers_Orders_Pdf extends Controller {
    private $db;

    function Suppliers_Orders_Pdf() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {

    }
}
