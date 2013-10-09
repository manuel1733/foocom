<?php

$design->header('Kunden Gruppen');

?>

<h1>Kunden Gruppen</h1>

<form action="admin.php?customers-groups-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('customers-groups') ?>

<?php if ($id == 0) : ?>
<h2>neuen Kunden Gruppen erfassen</h2>
<?php else: ?>
<h2>Kunden Gruppen &auml;ndern</h2>
<?php endif; ?>

<table>
	<tr>
		<td>Name</td>
		<td><input name="name" value="<?= $name ?>" /></td>
	</tr>
	<tr>
		<td>Rabatt</td>
		<td><input name="discount" value="<?= $discount ?>" />%</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="speichern" /></td>
	</tr>
</table>

</form>

<h2>Liste der Kunden Gruppen</h2>

<table>
	<tr>
		<th>#</th>
		<th>#</th>
		<th>Name</th>
		<th>Rabatt</th>
	</tr>
	<?php foreach ($groups as $r): extract($r); ?>
	<tr>
		<td><a href="admin.php?customers-groups-<?= $id ?>-delete">l&ouml;schen</a></td>
		<td><a href="admin.php?customers-groups-<?= $id ?>">&auml;ndern</a></td>
		<td><?= $name ?></td>
		<td><?= $discount ?>%</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
