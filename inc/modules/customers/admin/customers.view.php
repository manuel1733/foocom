<?php

$design->header('Kunden');

?>

<h1>Kunden</h1>

<h2>Neuen Kunden</h2>
<form action="admin.php?customers-create" method="post">
    <?= $this->insert_csrf_token('customers-create') ?>
    <input name="name" /> <input type="submit" value="anlegen" />
</form>

<table>
    <tr>
        <th>#</th>
        <th>#</th>
        <th>Name</th>
    </tr>

    <?php foreach($customers as $r): extract($r); ?>

    <tr>
        <td><a href="admin.php?customers-change-<?= $id ?>">&auml;ndern</a></td>
        <td><a href="admin.php?customers-delete-<?= $id ?>">l&ouml;schen</a></td>
        <td><?= $name ?></td>
    </tr>

    <?php endforeach; ?>

</table>

<?php

$design->footer();
