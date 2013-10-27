<?php

$design->header('Bestellungen');

?>

<h1>Bestellungen</h1>
<table>

	<tr>
		<th>Kunde</th>
		<th>Zahlungsweise</th>
		<th>Lieferung</th>
		<th>Anzahl Produkte</th>
		<th>Bestellsumme</th>
	</tr>
	<?php foreach ($orders as $r): extract($r); ?>
	<tr>
		<td><?= $name ?></td>
		<td><?= $payment_method ?></td>
		<td><?= $delivery_method ?></td>
		<td><?= $product_count ?></td>
		<td><?= $order_volume ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php

$design->footer();
