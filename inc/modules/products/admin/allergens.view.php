<?php

$design->header('Allergene');

?>

<h1>Allergene</h1>

<form action="admin.php?products-allergens-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('products-allergens') ?>

<?php if ($id == 0) : ?>
<h2>neuen Allergene erfassen</h2>
<?php else: ?>
<h2>Allergene &auml;ndern</h2>
<?php endif; ?>

<table>
	<tr>
		<td>Name</td>
		<td><input name="name" value="<?= $name ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="speichern" /></td>
	</tr>
</table>

</form>

<h2>Liste der Allergene</h2>

<table>
	<tr>
		<th>#</th>
		<th>#</th>
		<th>Name</th>
	</tr>
	<?php foreach ($allergens as $r): extract($r); ?>
	<tr>
		<td><a href="admin.php?products-allergens-<?= $id ?>-delete">l&ouml;schen</a></td>
		<td><a href="admin.php?products-allergens-<?= $id ?>">&auml;ndern</a></td>
		<td><?= $name ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
