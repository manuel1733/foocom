<?php

$design->header('Mitarbeiter Rollen');

?>

<h2>Rollen</h2>

<form action="admin.php?employees-roles" method="post">
<?= $this->insert_csrf_token('employees-roles') ?>

<table>
	<tr>
	    <th></th>
		<?php foreach ($roles as $role): ?>
		<th><?= $role['name'] ?></th>
		<?php endforeach; ?>
	</tr>
	<?php
    foreach ($permissions as $perm) {
	    echo '<th>' . $perm['name'] . '</th>';

    	foreach($roles as $role) {
	        if ($role['id'] == 1) {
        	    echo '<td><input type="checkbox" checked="checked" disabled="disabled" /></td>';
	        } else {
	            $checked = '0';
	            foreach ($perm['roles'] as $permRole) {
	                if ($permRole['id'] == $role['id']) {
	                    $checked = '1';
	                }
	            }
    	        echo '<td><input type="checkbox" name="r[' . $perm['id'] . '][' . $role['id'] . ']" ' . $this->out_checkbox($checked) . ' value="1" /></td>';
	        }
	    }
	    echo '</tr>';
	}

    ?>

    <tr>
        <td></td>
        <td colspan="3"><input type="submit" value="speichern" /></td>
    </tr>
</table>

</form>

<?php

$design->footer();
