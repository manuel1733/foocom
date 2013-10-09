<?php

defined('admin') or die ('no direct access');

include 'db.php';

class Vouchers extends Controller {
    private $db;

    function Vouchers() {
        $this->db = new Vouchers_Database();
    }

    function handle(Request $request) {
        $template = new Template('vouchers', 'vouchers');
        $template->display();
    }
}
