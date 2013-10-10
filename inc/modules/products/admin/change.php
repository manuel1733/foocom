<?php

defined('admin') or die ('no direct access');

include 'inc/modules/products/admin/db.php';

class Products_Change extends Controller {
    private $db;
    private $fields;

    function Products_Change() {
        $this->db = new Products_Database();
        $this->fields =  array(
            'name' => '',
            'ean' => '',
            'description' => '',
            'min_stock' => '',
            'order_quantity' => '',
            'food_value' => '',
            'ingredients' => '',
            'producer_id' => '',
        );
    }

    public function handle(Request $request) {
        if ($request->is_post('products-change')) {
            $this->handle_formular_submit($request);
        } else {
            $this->handle_formular_show($request);
        }
    }

    private function handle_formular_show(Request $request) {
        $id = $request->param(2);
        $template = new Template('products', 'change');
        $template->set('id', $id);
        $template->set_ar($this->db->get($id));
        $template->set_ar('allergens', $this->db->allergens_for($id));
        $template->set_ar('product_groups', $this->db->product_groups_for($id));
        $template->set_ar('labels', $this->db->labels_for($id));
        $template->set_ar('producers', $this->db->producers());
        $template->set_ar('customer_groups', $this->db->customer_groups_for($id));
        $template->set_ar('suppliers', $this->db->suppliers_for($id));
        $template->set_ar('available_suppliers', $this->db->suppliers_not($id));
        $template->display();
    }

    private function handle_formular_submit(Request $request) {
        $id = $request->param(2);

        $this->db->update($id, $request->populate($this->fields));

        $this->handle_select($request, $this->db->labels_for($id), $id, 'labels');
        $this->handle_select($request, $this->db->product_groups_for($id), $id, 'product_groups');
        $this->handle_select($request, $this->db->allergens_for($id), $id, 'allergens');

        $this->handle_image($id);

        $customer_price = $request->param('customer_price');
        $customer_display = $request->param('customer_display');
        foreach($request->param('customer_groups') as $gid) {
            $price = $customer_price[$gid];
            $display = empty($customer_display[$gid]) ? 0 : 1;
            $this->db->update_customer_group($id, $gid, $price, $display);
        }

        if ($request->param_exists('supplier_add')) {
            $this->db->add_supplier($id, $request->param('supplier_add'));
        }

        $supplier_product_number = $request->param('supplier_product_number');
        $supplier_purchase_price = $request->param('supplier_purchase_price');
        $supplier_order_quantity = $request->param('supplier_order_quantity');
        $supplier_delete = $request->param('supplier_delete');
        if ($request->param_exists('suppliers')) {
            foreach($request->param('suppliers') as $i => $sid) {
                if (!empty($supplier_delete[$sid])) {
                    $this->db->delete_supplier($id, $sid);
                } else {
                    $product_number = $supplier_product_number[$i];
                    $purchase_price = $supplier_purchase_price[$i];
                    $order_quantity = $supplier_order_quantity[$i];
                    $this->db->update_supplier($id, $sid, $product_number, $purchase_price, $order_quantity);
                }
            }
        }

        $request->forward('products-change-' . $id);
    }

    private function handle_select(Request $request, $iterator, $id, $name) {
        if ($request->param_exists($name)) {
            foreach($iterator as $row) {
                $is_selected = in_array($row['id'], $request->param($name));
                $was_selected = $row['selected'] != null;
                if ($was_selected && !$is_selected) {
                    $this->db->delete_select($name, $id, $row['id']);
                }
                if (!$was_selected && $is_selected) {
                    $this->db->add_select($name, $id, $row['id']);
                }
            }
        }
    }

    private function handle_image($id) {
        if (!empty($_FILES['image']['type']) && $_FILES['image']['type'] == 'image/jpeg') {
            $sour­cePath = 'images/'; // Path of orig­i­nal image
            $sourceUrl = 'http://domain.com/images/';
            $source­Name = 'test.jpg'; // Name of orig­i­nal image
            $thumb­Path = $sour­cePath . 'thumbs/'; // Write­able thumb path
            $thum­bUrl = $sourceUrl . 'thumbs/';
            $thumb­Name = "test_thumb.jpg"; // Tip: Name dynam­i­cally
            $thumb­Width = 60; // Intended dimen­sion of thumb

            // Beyond this point is sim­ply code.
            $sour­ceIm­age = image­cre­ate­fromjpeg($_FILES['image']['tmp_name']);
            $sourceWidth = imagesx($sour­ceIm­age);
            $source­Height = imagesy($sour­ceIm­age);

            $tar­ge­tIm­age = image­cre­ate($thumbWidth,$thumbWidth);
            image­copy­re­sized($targetImage,$sourceImage,0,0,0,0,$thumbWidth,
                $thumbWidth,imagesx($sourceImage),imagesy($sourceImage));
            image­jpeg($tar­ge­tIm­age, 'inc/modules/products/images/' . $id . '.jpeg');
        }

        // move_uploaded_file($_FILES['image']['tmp_name'], 'inc/modules/products/images/' . $id . '.' . $suffix);
    }
}
