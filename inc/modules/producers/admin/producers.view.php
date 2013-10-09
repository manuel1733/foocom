<?php

$design->header('Hersteller');

?>

<h1>Hersteller</h1>

<form action="admin.php?producers-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('producers') ?>

<?php if ($id == 0) : ?>
<h2>neuen Hersteller erfassen</h2>
<?php else: ?>
<h2>Hersteller &auml;ndern</h2>
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

<h2>Liste der Hersteller</h2>

<table>
	<tr>
		<th>#</th>
		<th>#</th>
		<th>Name</th>
	</tr>
	<?php foreach ($producers as $r): extract($r); ?>
	<tr>
		<td><a href="admin.php?producers-<?= $id ?>-delete">l&ouml;schen</a></td>
		<td><a href="admin.php?producers-<?= $id ?>">&auml;ndern</a></td>
		<td><?= $name ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

$design->footer();
