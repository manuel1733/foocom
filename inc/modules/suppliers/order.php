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


switch ($request->param(2)) {
    case 'create' :
        $sid = $request->param_as_number(3);
        $id = $sdb->create_order($sid);
        header('location: index.php?suppliers-order-change-' . $id);
        break;
    case 'change' :
        include 'order_change.php';
        break;
}
