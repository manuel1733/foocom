<?php

class Customers_Basket extends Controller {
    private $db;

    function Customers_Basket() {
        $this->db = new Customers_Database();
    }

    function handle(ORequest $request) {
        if ($request->is_post('product-add-to-basket')) {

            $id = $request->param_as_number('id');
            $quantity = $request->param_as_number('quantity');

            if (empty($_SESSION['customer-basket'][$id])) {
                $_SESSION['customer-basket'][$id] = $quantity;
            } else {
                $_SESSION['customer-basket'][$id] = $_SESSION['customer-basket'][$id] + $quantity;
            }

            $request->forward('products-' . $id);
        } else {
            $template = new Template('customers', 'basket');
            $template->display();
        }
    }
}
