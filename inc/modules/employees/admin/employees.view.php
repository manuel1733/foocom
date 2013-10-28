<?php

$design->header('Mitarbeiter');

?>

<h1>Mitarbeiter</h1>

<form action="admin.php?employees-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('employees') ?>

<table>
    <tr>
        <td>Vorname</td>
        <td><input name="first_name" value="<?= $first_name ?>" /></td>
    </tr>
    <tr>
        <td>Nachname</td>
        <td><input name="last_name" value="<?= $last_name ?>" /></td>
    </tr>
    <tr>
        <td>Mail</td>
        <td><input name="mail" value="<?= $mail ?>" /></td>
    </tr>
    <tr>
        <td>Rolle</td>
        <td><select name="role_id"><?= $this->out_options($roles, $role_id) ?></select></td>
    <tr>
        <td></td>
        <td><input type="submit" value="speichern" /></td>
    </tr>
</table>

</form>

<table>
    <tr>
        <th>#</th>
        <th>#</th>
        <th>#</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>Mail</th>
        <th>Role</th>
    </tr>

    <?php foreach ($employees as $r ) : extract($r); ?>

    <tr>
        <td><a href="admin.php?employees-<?= $id ?>-delete">l&ouml;schen</a></td>
        <td><a href="admin.php?employees-<?= $id ?>">&auml;ndern</a></td>
        <td><a href="admin.php?employees-<?= $id ?>-password">neues Passwort</a></td>
        <td><?= $first_name ?></td>
        <td><?= $last_name ?></td>
        <td><?= $mail ?></td>
        <td><?= $role['name'] ?></td>

    <?php endforeach; ?>

</table>

<?php

$design->footer();
