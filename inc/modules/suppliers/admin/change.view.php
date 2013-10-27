<?php

$design->header('Lieferant &auml;ndern');

?>

<form action="admin.php?suppliers-change-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('suppliers-change') ?>

<h2>Lieferant &auml;ndern</h2>

<table>
	<tr>
		<td>Name</td>
		<td><input name="name" value="<?= $name ?>" /></td>
	</tr>
	<tr>
		<th colspan="2">Adresse</th>
	</tr>
	<tr>
		<td>Zusatz</td>
		<td><input name="addition" value="<?= $addition ?>" /></td>
	</tr>
	<tr>
		<td>Strasse / Nr.</td>
		<td><input name="street" value="<?= $street ?>" /></td>
	</tr>
	<tr>
		<td>PLZ</td>
		<td><input name="zipcode" value="<?= $zipcode ?>" /></td>
	</tr>
	<tr>
		<td>Ort</td>
		<td><input name="city" value="<?= $city ?>" /></td>
	</tr>
	<tr>
		<td>Land</td>
		<td><select name="country"><?= $this->out_options($countries, $country) ?></select></td>
	</tr>
	<tr>
		<th colspan="2">Kontakt</th>
	</tr>
	<tr>
		<td>Telefon</td>
		<td><input name="phone" value="<?= $phone ?>" /></td>
	</tr>
	<tr>
		<td>Fax</td>
		<td><input name="fax" value="<?= $fax ?>" /></td>
	</tr>
	<tr>
		<td>Mail</td>
		<td><input name="mail" value="<?= $mail ?>" /></td>
	</tr>
	<tr>
		<th colspan="2">Kommentare</th>
	</tr>
	<tr>
		<td colspan="2"><textarea name="comment" cols="50" rows="5"><?= $comment ?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input value="speichern" type="submit" /></td>
	</tr>
</table>
</form>

<?php

$design->footer();
