<?php

class Customers_Checkout_Done extends Controller {

    function handle(ORequest $request) {
        $template = new Template('customers', 'checkout.done');
        $template->display();
    }
}
