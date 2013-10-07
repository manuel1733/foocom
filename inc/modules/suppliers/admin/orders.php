<?php

/**
 * 1 create new order ...
 * 2 produkte hinzufuegen
 *     a alle produkte die lieferant liefern kann und die lager menge kleiner als mindest bestand ist
 *         vorschlag bestell menge ist mindest bestell menge fuer den lieferant
 *      b kunden bestellungen auswerten der letzten x monate / jahre und dann hochrechnen
 *      c produkte aus eigenem katalog waehlen und dem lieferant zuordnen und der bestellung zuordnen
 *   erstmal einfach produkt hinzufuegen... wegen mindest bestellmenge und mindest stock usw. die dem lieferant gehoeren
 *   bestell vorschlag dann spaeter erweitern mit bestellungen (vorbestellungen etc)
 *
 * 3 states
 *   state is in process
 *   state is freigegeben
 *   state is bestellt
 *   state is geliefert
 *   state is rechnung erhalten
 *   state is rechnung bezahlt
 *
 */

defined('admin') or die ('no direct access');

include 'db.php';

class Suppliers_Orders extends Controller {
    private $db;

    function Suppliers_Orders() {
        $this->db = new Suppliers_Database();
    }

    function handle(Request $request) {
        $supplier_id = $request->param_as_number(2);
        if ($request->is_post('supplier-order-create')) {
            $order_id = $this->db->create_order($supplier_id);
            $request->forward('suppliers-orders-change-' . $order_id);
        } else {
            $template = new Template('suppliers', 'orders');
            $template->set('id', $supplier_id);
            $template->set_ar('orders', $this->db->all_orders($supplier_id));
            $template->display();
        }
    }
}
