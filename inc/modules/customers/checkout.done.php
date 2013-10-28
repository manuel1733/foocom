<?php

class Customers_Checkout_Done extends Controller {

    function handle(ORequest $request) {
        $template = new Template('cusotmers', 'checkout.done');
        $template->display();
    }
}
