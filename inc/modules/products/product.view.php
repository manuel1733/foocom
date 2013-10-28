<?php

$design->header('Produkte');

?>

<h1><?= $name ?></h1>

<br />
Preis: <td><?= $price ?></td>
<br />
<br />

<form action="index.php?customers-basket" method="post">
<?= $this->insert_csrf_token('product-add-to-basket') ?>
<input type="hidden" name="id" value="<?= $id ?>" />

Menge: <input name="quantity" value="1" size="2" />
<input type="submit" value="In den Einkaufswagen" />
</form>

<br />
<br />

<?= $description ?>

<?php

$design->footer();
