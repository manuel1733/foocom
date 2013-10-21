<?php

$design->header('Mitarbeiter Rollen');

?>

<h2>Rollen</h2>

<form action="admin.php?employees-roles" method="post">
<?= $this->insert_csrf_token('employees-roles') ?>

<table>
	<tr>
	    <th></th>
		<?php foreach ($roles as $r) : extract($r); ?>
		<th><?= $role ?></th>
		<?php endforeach; ?>
	</tr>
	<?php
	$old_path = null;
	foreach ($paths as $r) : extract($r);
	if ($old_path != $path) {
	    if ($old_path != null) {
	        echo '</tr>';
	    }
	    echo '<tr><th>' . $path . '</th>';
	    echo '<td><input type="checkbox" checked="checked" disabled="disabled" /></td>';
	}
    echo '<td><input type="checkbox" name="r[' . $path . '][' . $role . ']" ' . $this->out_checkbox($checked) . ' value="1" /></td>';
	$old_path = $path;
    endforeach;
    echo '</tr>';
    ?>

    <tr>
        <td></td>
        <td colspan="3"><input type="submit" value="speichern" /></td>
    </tr>
</table>



</form>

<?php

$design->footer();
