<?php
function show_selectable($iterator, $name) {
    ?>
            <div id="<?php echo $name; ?>_dialog" title="w&auml;hlen, Ctrl gedr&uuml;ckt halten">
                <ul id="<?php echo $name; ?>_selectable" class="ui-selectable">
                    <?php
                    foreach ($iterator as $row) {
                        $selected = ($row['selected'] == null ? '' : ' ui-selected');
                        echo '<li id="' . $name . '_' . $row['id'] . '" class="ui-widget-content' . $selected .'">';
                        echo $row['name'] . "</li>\n";
                    }
                    ?>
                </ul>
                Ausgew&auml;hlt: <input id="<?php echo $name; ?>_result" name="<?php echo $name; ?>_result" readonly="readonly"/>
            </div>
            <script type="text/javascript">
                $(function() {
                	$( "#<?php echo $name; ?>_selectable" ).selectable({
                    	stop: function () {
                        	var result = $('#<?php echo $name; ?>_result');
                        	result.val('');
                    		$('.ui-selected', this).each(function() {
                        		var selected_id = $(this).attr('id').replace('<?php echo $name; ?>_', '');
                        		result.val(result.val() + selected_id + ', ');
                    		});
                    	}
                	});
                });
            </script>
    <?php
}

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

?>

<h1>Produkte</h1>

<table>
    <tr>
        <td>Name</td>
        <td><input name="name" value="<?php echo 'aaa' ?>" /></td>
    </tr>
    <tr>
        <td>EAN</td>
        <td><input name="ean" value="{ean}" /></td>
    </tr>
    <tr>
        <td>Min. an Lager</td>
        <td><input name="min_stock" value="{min_stock}" /></td>
    </tr>
    <tr>
        <td>Bestellmenge</td>
        <td><input name="order_quantity" value="{order_quantity}" /></td>
    </tr>
    <tr>
        <td>Labels</td>
        <td><?php show_selectable($pdb->labels_for($id), 'labels'); ?></td>
    </tr>
    <tr>
    	<td>Warengruppe</td>
        <td><?php show_selectable($pdb->product_groups_for($id), 'customer_groups'); ?></td>
    </tr>
    <tr>
        <td>Allergene</td>
        <td><?php show_selectable($pdb->allergens_for($id), 'allergens'); ?></td>
    </tr>
    <tr>
        <td>N&auml;hrwerte</td>
        <td><input name="food_value" value="{food_value}" /></td>
    </tr>
    <tr>
        <td>Zutaten</td>
        <td><input name="ingredients" value="{ingredients}" /></td>
    </tr>
    <tr>
        <td>Hersteller</td>
        <td><select name="producer"><?php select_options($pdb->producers(), $fields['producer']); ?></select></td>
    </tr>
    <tr>
        <th colspan="2">Beschreibung</th>
    </tr>
    <tr>
        <td colspan="2"><textarea name="description" cols="50" rows="10">{description}</textarea></td>
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
            <input type="hidden" name="customer_group[]" value="<?php echo $row['id']; ?>" />
        </td>
    </tr>
    <tr>
        <td>Preis</td>
        <td><input name="customer_price[]" value="<?php echo $row['price']; ?>" /></td>
    </tr>
    <tr>
        <td>Sichtbar</td>
        <td><input type="checkbox" name="customer_show[]"<?php echo checkbox($row['display']); ?> /> </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="2">Lieferanten</th>
    </tr>
    <!-- {SPLIT} -->
    <tr>
        <td align="center" colspan="2">{supplier}<input type="hidden" name="supplier_id[]" value="{supplier_id}" /></td>
    </tr>
    <tr>
        <td>Artikel Nr.</td>
        <td><input name="product_number[]" value="{product_number}" /></td>
    </tr>
    <tr>
        <td>Einkaufspreis</td>
        <td><input name="purchase_price[]" value="{purchase_price}" /></td>
    </tr>
    <tr>
        <td>Min. Bestellmenge</td>
        <td><input name="purchase_price[]" value="{purchase_price}" /></td>
    </tr>
    <!-- {SPLIT} -->
    <tr>
        <td>Lieferanten</td>
        <td>hinzuf&uuml;gen <select id="suppliers"><option>w&auml;hlen</option>{suppliers}</select></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="speichern" />
    </td>
</table>

<script type="text/javascript">

$('#suppliers').change(function() {
	var selected_item = $('#suppliers :selected');
	var supplier_name = selected_item.text();
	var supplier_id = selected_item.val();
	$('<tr><td align="center" colspan="2">' + supplier_name +
		'<input type="hidden" name="supplier_id[]" value="' + supplier_id + '" /></td></tr>' +
		'<tr><td>Artikel Nr.</td><td><input name="product_number[]" /></td></tr>' +
    	'<tr><td>Einkaufspreis</td><td><input name="purchase_price[]" /></td>' +
    	'</tr>').insertBefore($('#suppliers').parent().parent());
	selected_item.remove();
});

$('#allergens').change(function() {
	var selected_item = $('#allergens :selected');
	var allergen_name = selected_item.text();
	var allergen_id = selected_item.val();
	$('#allergens').parent().append('<span id="allergen_' + allergen_id + '"><a href="javascript:delete_allergen(' + allergen_id + ');">x</a> ' + allergen_name + '<input type="hidden" name="allergens[]" value="' + allergen_id + '" />, </span>');
	selected_item.remove();
});

function delete_allergen(allergen_id) {
	$('#allergen_' + allergen_id).remove();
}

$('#labels').change(function() {
	var selected_item = $('#labels :selected');
	var label_name = selected_item.text();
	var label_id = selected_item.val();
	$('#labels').parent().append('<span id="label_' + label_id + '"><a href="javascript:delete_label(' + label_id + ');">x</a> ' + label_name + '<input type="hidden" name="labels[]" value="' + label_id + '" />, </span>');
	selected_item.remove();
});

function delete_label(label_id) {
	$('#label_' + label_id).remove();
}

$('#product_groups').change(function() {
	var selected_item = $('#product_groups :selected');
	var name = selected_item.text();
	var id = selected_item.val();
	$('#product_groups').parent().append('<span id="product_group_' + id + '"><a href="javascript:delete_product_group(' + id + ');">x</a> ' + name + '<input type="hidden" name="product_groups[]" value="' + id + '" />, </span>');
	selected_item.remove();
});

function delete_product_group(id) {
	$('#product_group_' + id).remove();
}

</script>
