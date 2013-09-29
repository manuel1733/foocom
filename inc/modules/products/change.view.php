<?php

function checkbox($value) {
    if ($value == 0) {
        return '';
    } else {
        return ' checked="checked"';
    }
}

function select_options(array $options, $key) {
    foreach ($options as $k => $v) {
        if ($key == $k) {
            echo '<option value="' . $k . '" selected="selected">' . $v . '</option>';
        } else {
            echo '<option value="' . $k . '">' . $v . '</option>';
        }
    }
}

function select_options_multiple($iterator) {
    echo '<option value="0">keine</option>';
    foreach ($iterator as $row) {
        $k = $row['id'];
        $v = $row['name'];
        if ($row['selected'] == null) {
            echo '<option value="' . $k . '">' . $v . '</option>';
        } else {
            echo '<option value="' . $k . '" selected="selected">' . $v . '</option>';
        }
    }
}

function o($value) {
    echo htmlspecialchars($value, ENT_COMPAT | ENT_HTML401, 'UTF-8');
}

?>

<h1>Produkte</h1>

<form action="index.php?products-change-<?php echo $id; ?>" method="post">

<table>
    <tr>
        <td>Name</td>
        <td><input name="name" value="<?php o($fields['name']); ?>" /></td>
    </tr>
    <tr>
        <td>EAN</td>
        <td><input name="ean" value="<?php o($fields['ean']); ?>" /></td>
    </tr>
    <tr>
        <td>Min. an Lager</td>
        <td><input name="min_stock" value="<?php o($fields['min_stock']); ?>" /></td>
    </tr>
    <tr>
        <td>Bestellmenge</td>
        <td><input name="order_quantity" value="<?php o($fields['order_quantity']); ?>" /></td>
    </tr>
    <tr>
        <td>Labels</td>
        <td><select name="labels[]" multiple="multiple" size="3"><?php select_options_multiple($pdb->labels_for($id)); ?></select></td>
    </tr>
    <tr>
    	<td>Warengruppe</td>
        <td><select name="product_groups[]" multiple="multiple" size="3"><?php select_options_multiple($pdb->product_groups_for($id)); ?></select></td>
    </tr>
    <tr>
        <td>Allergene</td>
        <td><select name="allergens[]" multiple="multiple" size="3"><?php select_options_multiple($pdb->allergens_for($id)); ?></select></td>
    </tr>
    <tr>
        <td>N&auml;hrwerte</td>
        <td><input name="food_value" value="<?php o($fields['food_value']); ?>" /></td>
    </tr>
    <tr>
        <td>Zutaten</td>
        <td><input name="ingredients" value="<?php o($fields['ingredients']); ?>" /></td>
    </tr>
    <tr>
        <td>Hersteller</td>
        <td><select name="producer_id"><?php select_options($pdb->producers(), $fields['producer_id']); ?></select></td>
    </tr>
    <tr>
        <th colspan="2">Beschreibung</th>
    </tr>
    <tr>
        <td colspan="2"><textarea name="description" cols="50" rows="10"><?php o($fields['description']); ?></textarea></td>
    </tr>
    <tr>
        <th colspan="2">Bilder</th>
    </tr>
    <tr>
        <td colspan="2">upload</td>
    </tr>
    <tr>
        <th colspan="2">Kundengruppen</th>
    </tr>
    <?php foreach($pdb->customer_groups_for($id) as $row): ?>
    <tr>
        <td align="center" colspan="2">
            <?php echo $row['name']; ?>
            <input type="hidden" name="customer_groups[]" value="<?php echo $row['id']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Preis</td>
        <td><input name="customer_price[<?php echo $row['id']; ?>]" value="<?php echo $row['price']; ?>" /></td>
    </tr>
    <tr>
        <td>Sichtbar</td>
        <td><input type="checkbox" name="customer_display[<?php echo $row['id']; ?>]"<?php echo checkbox($row['display']); ?> /> </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="2">Lieferanten</th>
    </tr>
    <?php foreach($pdb->suppliers_for($id) as $row): ?>
    <tr>
        <td align="center" colspan="2">
            <?php echo $row['name']; ?>
            (<input type="checkbox" name="supplier_delete[<?php echo $row['id']; ?>]" value="y" />  l&ouml;schen)
            <input type="hidden" name="suppliers[]" value="<?php echo $row['id']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Artikel Nr.</td>
        <td><input name="supplier_product_number[]" value="<?php echo $row['product_number']; ?>" /></td>
    </tr>
    <tr>
        <td>Einkaufspreis</td>
        <td><input name="supplier_purchase_price[]" value="<?php echo $row['purchase_price']; ?>" /></td>
    </tr>
    <tr>
        <td>Min. Bestellmenge</td>
        <td><input name="supplier_order_quantity[]" value="<?php echo $row['order_quantity']; ?>" /></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td>Lieferanten</td>
        <td>hinzuf&uuml;gen <select name="supplier_add"><option value="0">w&auml;hlen</option><?php select_options($pdb->suppliers_not($id), 0); ?></select></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="speichern" />
    </td>
</table>

</form>
