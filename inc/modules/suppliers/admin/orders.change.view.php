<?php

$design->header('Einkauf Bestellung');

?>

<form action="admin.php?suppliers-orders-change-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('supplier-order-change') ?>

<table>

    <tr>
        <th colspan="4">Produkt</th>
        <th colspan="3">Lieferant</th>
        <th></th>
        <th></th>
    </tr>

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Mindestlager</th>
        <th>Bestellmenge</th>
        <th>Nummer</th>
        <th>Preis</th>
        <th>Bestellmenge</th>
        <th>Lagermenge</th>
        <th>Bestellmenge</th>
    </tr>

    <?php foreach ($products as $r) : extract($r); ?>

    <tr>
        <td><?= $id ?></td>
        <td><?= $name ?></td>
        <td><?= $min_stock ?></td>
        <td><?= $order_quantity ?></td>
        <td><?= $product_number ?></td>
        <td><?= $purchase_price ?></td>
        <td><?= $supplier_order_quantity ?></td>
        <td><?= $stock_amount ?></td>
        <td><input name="order_quantity[<?= $id ?>]" value="<?= $order_amount ?>" size="5" /></td>
    </tr>

    <?php endforeach; ?>

    <?php if ($product_search == 2): ?>

    <tr>
        <td colspan="3">Produkt hinzuf&uuml;gen</td>
        <td>nach Id</td>
        <td><input name="search_id" size="5" /></td>
        <td colspan="2">nach Name</td>
        <td colspan="2"><input name="search_name" /></td>
    </tr>

    <?php endif; ?>

    <tr>
        <td colspan="8"></td>
        <td><input type="submit" value="speichern" /></td>
    </tr>


</table>

</form>

<?php

$design->footer();

