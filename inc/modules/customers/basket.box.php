<?php

class Customers_Basket_Box {

    private $db;

    public function Customers_Basket_Box() {
        $this->db = new Customers_Database();
    }

    public function display(Request $request) {
        if ($request->is_post('customers_basket_box')) {
            $basket = $request->param('quantity');
            if (is_array($basket)) {
                foreach ($basket as $product_id => $quantity) {
                    $_SESSION['customer-basket'][$product_id] = $quantity;
                }
            }
        }
        $basket = array();
        if (!empty($_SESSION['customer-basket'])) {
            $basket = $_SESSION['customer-basket'];
        }
        $template = new Template('customers', 'basket.box');
        $template->set('product_count', array_sum($basket));
        $template->set_ar('products', $this->db->basket($basket));
        $template->display();
    }
}
