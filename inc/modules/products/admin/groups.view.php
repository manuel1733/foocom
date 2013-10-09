<?php

$design->header('Produkt Gruppen');

?>

<h1>Produkt Gruppen</h1>

<form action="admin.php?products-groups-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('products-groups') ?>

<?php if ($id == 0) : ?>
<h2>neuen Produkt Gruppen erfassen</h2>
<?php else: ?>
<h2>Produkt Gruppen &auml;ndern</h2>
<?php endif; ?>

<table>
	<tr>
		<td>Name</td>
		<td><input name="name" value="<?= $name ?>" /></td>
	</tr>
	<tr>
		<td>Eltern Gruppe</td>
		<td><select name="parent"><option>w&auml;hlen</option><?= $this->out_options($groups, $group) ?></select></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="speichern" /></td>
	</tr>
</table>

</form>

<h2>Liste der Produkt Gruppen</h2>

<table>
	<tr>
		<th>#</th>
		<th>#</th>
		<th>Name</th>
	</tr>
	<?php foreach ($groups as $r): extract($r); ?>
	<tr>
		<td><a href="admin.php?products-groups-<?= $id ?>-delete">l&ouml;schen</a></td>
		<td><a href="admin.php?products-groups-<?= $id ?>">&auml;ndern</a></td>
		<td><?= $name ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
