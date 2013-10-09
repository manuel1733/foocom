<?php

$design->header('Einkauf Bestellung');

?>

<form action="admin.php?suppliers-orders-receipt-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('supplier-order-receipt') ?>

<table>
    <tr>
        <th></th>
        <th></th>
        <th>MHD</th>
        <th>Menge</th>
        <th>Lagerplatz</th>
    </tr>

    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Lieferant Nummer</td>
        <td>Bestellmenge</td>
        <td></td>
    </tr>

    <?php foreach ($products as $r) : extract($r); ?>

    <tr>
        <td><?= $id ?></td>
        <td><?= $name ?></td>
        <td><?= $product_number ?></td>
        <td><?= $order_amount ?></td>
        <td></td>
    </tr>


    <?php foreach ($batches as $r2) : extract($r2) ?>

    <tr>
        <td></td>
        <td></td>
        <td><input name="best_before[<?= $id ?>][<?= $ib ?>]" size="10" value="<?= $best_before ?>" /></td>
        <td><input name="order_quantity[<?= $id ?>][<?= $ib ?>]" size="5" value="<?= $order_quantity ?>" /></td>
        <td><select name="storage_yard[<?= $id ?>][<?= $ib ?>]"><? $this->out_options($storage_yards, $storage_yard_id)?></select></td>
    </tr>

    <?php endforeach; ?>

    <?php endforeach; ?>

    <tr>
        <td colspan="4"></td>
        <td><input type="submit" value="aktualisieren" /></td>
    </tr>


</table>

</form>

<h2>Fragen</h2>
<ol>
    <li>wenn zuviel geliefert wurde fuer ein Produkt: Die urspruengliche Bestellung anpassen?</li>
    <li>wenn zu wenig geliefert wurde fuer ein Produkt: Eine neue Bestellung mit den fehlenden Produkten erstellen. Als Menge die Differenz eintragen.</li>
</ol>


<?php

$design->footer();

