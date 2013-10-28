<?php

$design->header('Lieferanten Bestellung');

?>

<h1>Lieferanten Bestellung</h1>

<h2>Neuen Bestellung</h2>
<form action="admin.php?suppliers-orders-<?= $id ?>" method="post">
    <?= $this->insert_csrf_token('supplier-order-create') ?>
    <input type="submit" value="anlegen" />
</form>

<table>
    <tr>
        <th>#</th>
        <th>#</th>
        <th>#</th>
        <th>Nummer</th>
    </tr>

    <?php foreach($orders as $r): extract($r); ?>

    <tr>
        <?php if ($state == 0 ): ?>
        <td><a href="admin.php?suppliers-orders-change-<?= $id ?>">&auml;ndern</a></td>
        <td><a href="admin.php?suppliers-delete-<?= $id ?>">l&ouml;schen</a></td>
        <td><a href="admin.php?suppliers-orders-close-<?= $id ?>">schliessen</a></td>
        <?php elseif($state == 1): ?>
        <td><a href="admin.php?suppliers-orders-pdf-<?= $id ?>">pdf</a></td>
        <td><a href="admin.php?suppliers-orders-close-<?= $id ?>">e-dec</a></td>
        <td><a href="admin.php?suppliers-orders-receipt-<?= $id ?>">eingang</a></td>
        <?php endif; ?>
        <td><?= $id ?></td>
    </tr>

    <?php endforeach; ?>

</table>

<?php

$design->footer();
