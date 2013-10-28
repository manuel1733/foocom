<?php

$design->header('Lieferanten Bestellung');

?>

<h2>Wareneingang</h2>

<table>
	<tr>
		<th>#</th>
		<th>Lieferant</th>
		<th>Bestell-Nummer</th>
	</tr>

	<?php foreach ($orders as $r): extract($r); ?>
	<tr>
	    <td><a href="admin.php?suppliers-orders-receipt-<?= $id ?>">eingang</a></td>
	    <td><?= $supplier['name'] ?></td>
	    <td><?= $id ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
