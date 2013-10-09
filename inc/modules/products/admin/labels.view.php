<?php

$design->header('Labels');

?>

<h1>Labels</h1>

<form action="admin.php?products-labels-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('products-labels') ?>

<?php if ($id == 0) : ?>
<h2>neuen Labels erfassen</h2>
<?php else: ?>
<h2>Labels &auml;ndern</h2>
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

<h2>Liste der Labels</h2>

<table>
	<tr>
		<th>#</th>
		<th>#</th>
		<th>Name</th>
	</tr>
	<?php foreach ($labels as $r): extract($r); ?>
	<tr>
		<td><a href="admin.php?products-labels-<?= $id ?>-delete">l&ouml;schen</a></td>
		<td><a href="admin.php?products-labels-<?= $id ?>">&auml;ndern</a></td>
		<td><?= $name ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
