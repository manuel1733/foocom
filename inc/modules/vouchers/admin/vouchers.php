<?php

defined('admin') or die ('no direct access');

class Vouchers extends Controller {
    private $db;

    function Vouchers() {
        $this->db = new Vouchers_Database();
    }

    function handle(ORequest $request) {
        $template = new Template('vouchers', 'vouchers');
        $template->display();
    }
}
