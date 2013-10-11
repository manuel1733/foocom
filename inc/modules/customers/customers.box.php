<?php

class Customers_Customers_Box {
    public function display() {
        $template = new Template('customers', 'customers.box');
        $template->display();
    }
}
