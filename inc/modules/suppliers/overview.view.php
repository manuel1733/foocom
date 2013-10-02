<?php

$design->header('Lieferanten');

?>

<h1>Lieferanten</h1>

<h2>Neuen Lieferant</h2>
<form action="index.php?suppliers-create" method="post">
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
        <td><a href="index.php?suppliers-change-<?= $user_id ?>">&auml;ndern</a></td>
        <td><a href="index.php?suppliers-delete-<?= $user_id ?>">l&ouml;schen</a></td>
        <td><a href="index.php?suppliers-order-<?= $user_id ?>">bestellen</a></td>
        <td><?= $name ?></td>
    </tr>

    <?php endforeach; ?>

</table>

<?php

$design->footer();
