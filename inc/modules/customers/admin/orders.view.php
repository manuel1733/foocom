<?php

$design->header('Bestellungen');

?>

<h1>Bestellungen</h1>
<table>
<?php foreach ($orders as $r): extract($r); ?>
    <tr>
        <th>Kunde</th>
        <th>Zahlungsweise</th>
        <th>Lieferung</th>
        <th>Anzahl Produkte</th>
        <th>Bestellsumme</th>
    </tr>
<?php endforeach; ?>
    <tr>
        <td><?= $name ?></td>
        <td><?= $payment_method ?></td>
        <td><?= $delivery_method ?></td>
        <td><?= $product_count ?></td>
        <td><?= $order_volume ?></td>
    </tr>
</table>
<?php

$design->footer();
