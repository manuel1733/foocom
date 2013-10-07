<?php

$design->header('Lieferanten');

?>

<h1>Lieferanten</h1>

<h2>Neuen Lieferant</h2>
<form action="admin.php?suppliers-create" method="post">
    <?= $this->insert_csrf_token('suppliers-create') ?>
    <input name="name" /> <input type="submit" value="anlegen" />
</form>

<table>
    <tr>
        <th>#</th>
        <th>#</th>
        <th>#</th>
        <th>Name</th>
    </tr>

    <?php foreach($suppliers as $r): extract($r); ?>

    <tr>
        <td><a href="admin.php?suppliers-change-<?= $id ?>">&auml;ndern</a></td>
        <td><a href="admin.php?suppliers-delete-<?= $id ?>">l&ouml;schen</a></td>
        <td><a href="admin.php?suppliers-orders-<?= $id ?>">Bestellungen</a></td>
        <td><?= $name ?></td>
    </tr>

    <?php endforeach; ?>

</table>

<?php

$design->footer();
