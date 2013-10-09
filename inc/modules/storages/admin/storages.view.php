<?php

$design->header('Lagerverwaltung');

?>

<h1>Lagerverwaltung</h1>

<form action="admin.php?storages" method="post">
<?= $this->insert_csrf_token('storages') ?>
<table>

<?php foreach($storages as $r): ?>

    <tr>
        <td>Lager</td>
        <td><input name="name[<?= $r['id'] ?>]" value="<?= $r['name'] ?>" /></td>
        <td></td>
    </tr>

    <?php foreach($r['yards'] as $yard): ?>

        <tr>
        <td></td>
        <td>Lagerplatz</td>
        <td><input name="number[<?= $r['id'] ?>][<?= $yard['id'] ?>]" value="<?= $yard['number'] ?>" /></td>
    </tr>

    <?php endforeach; ?>


    <tr>
        <td></td>
        <td>neuer Lagerplatz</td>
        <td><input name="new_number[<?= $r['id'] ?>]" /></td>
    </tr>

<?php endforeach; ?>

    <tr>
        <td>neues Lager</td>
        <td><input name="new_name" /></td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td><input type="submit" value="speichern" /></td>
        <td></td>
    </tr>
</table>
</form>
<?php

$design->footer();
