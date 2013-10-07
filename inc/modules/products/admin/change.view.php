<?php

$design->header('Produkt aendern');

?>

<h1>Produkte</h1>

<form action="admin.php?products-change-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('products-change') ?>

<table>
    <tr>
        <td>Name</td>
        <td><input name="name" value="<?= $name ?>" /></td>
    </tr>
    <tr>
        <td>EAN</td>
        <td><input name="ean" value="<?= $ean ?>" /></td>
    </tr>
    <tr>
        <td>Min. an Lager</td>
        <td><input name="min_stock" value="<?= $min_stock ?>" /></td>
    </tr>
    <tr>
        <td>Bestellmenge</td>
        <td><input name="order_quantity" value="<?= $order_quantity ?>" /></td>
    </tr>
    <tr>
        <td>Labels</td>
        <td><select name="labels[]" multiple="multiple" size="3"><?= $this->out_options($labels) ?></select></td>
    </tr>
    <tr>
    	<td>Warengruppe</td>
        <td><select name="product_groups[]" multiple="multiple" size="3"><?= $this->out_options($product_groups) ?></select></td>
    </tr>
    <tr>
        <td>Allergene</td>
        <td><select name="allergens[]" multiple="multiple" size="3"><?= $this->out_options($allergens) ?></select></td>
    </tr>
    <tr>
        <td>N&auml;hrwerte</td>
        <td><input name="food_value" value="<?= $food_value ?>" /></td>
    </tr>
    <tr>
        <td>Zutaten</td>
        <td><input name="ingredients" value="<?= $ingredients ?>" /></td>
    </tr>
    <tr>
        <td>Hersteller</td>
        <td><select name="producer_id"><?= $this->out_options($producers, $producer_id) ?></select></td>
    </tr>
    <tr>
        <th colspan="2">Beschreibung</th>
    </tr>
    <tr>
        <td colspan="2"><textarea name="description" cols="50" rows="10"><?= $description ?></textarea></td>
    </tr>
    <tr>
        <th colspan="2">Bilder</th>
    </tr>
    <tr>
        <td colspan="2"><input type="file" name="file" /></td>
    </tr>
    <tr>
        <th colspan="2">Kundengruppen</th>
    </tr>
    <?php foreach($customer_groups as $r): extract($r); ?>
    <tr>
        <td align="center" colspan="2">
            <?= $name; ?>
            <input type="hidden" name="customer_groups[]" value="<?= $id ?>" />
        </td>
    </tr>
    <tr>
        <td>Preis</td>
        <td><input name="customer_price[<?= $id ?>]" value="<?= $price ?>" /></td>
    </tr>
    <tr>
        <td>Sichtbar</td>
        <td><input type="checkbox" name="customer_display[<?= $id ?>]"<?= $this->out_checkbox($display) ?> /> </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="2">Lieferanten</th>
    </tr>
    <?php foreach($suppliers as $r): extract($r); ?>
    <tr>
        <td align="center" colspan="2">
            <?= $name ?>
            (<input type="checkbox" name="supplier_delete[<?= $id ?>]" value="y" />  l&ouml;schen)
            <input type="hidden" name="suppliers[]" value="<?= $id ?>" />
        </td>
    </tr>
    <tr>
        <td>Artikel Nr.</td>
        <td><input name="supplier_product_number[]" value="<?= $product_number ?>" /></td>
    </tr>
    <tr>
        <td>Einkaufspreis</td>
        <td><input name="supplier_purchase_price[]" value="<?= $purchase_price ?>" /></td>
    </tr>
    <tr>
        <td>Min. Bestellmenge</td>
        <td><input name="supplier_order_quantity[]" value="<?= $order_quantity ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td>Lieferanten</td>
        <td>hinzuf&uuml;gen <select name="supplier_add"><option value="0">w&auml;hlen</option><?= $this->out_options($available_suppliers) ?></select></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="speichern" />
    </td>
</table>

</form>

<?php

$design->footer();
