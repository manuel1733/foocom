<?php

$design->header('Produkte');

?>

<table>
    <tr>
        <td>Name</td>
        <td>Beschreibung</td>
        <td>Preis</td>
    </tr>
<?php foreach ($products as $r): extract($r); ?>
    <tr>
        <td><a href="index.php?products-<?= $id ?>"><?= $name ?></a></td>
        <td><?= $description ?></td>
        <td><?= $price ?></td>
    </tr>
<?php endforeach; ?>
</table>

<?php

$design->footer();
