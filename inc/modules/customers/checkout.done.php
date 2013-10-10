<?php

include 'inc/modules/customers/db.php';

class Customers_Checkout_Done extends Controller {

    function handle(Request $request) {
        $template = new Template('cusotmers', 'checkout.done');
        $template->display();
    }
}
