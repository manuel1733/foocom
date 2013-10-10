<?php

$design->header('Produkte');

?>

<table>
    <tr>
        <td>Name</td>
        <td>Beschreibung</td>
    </tr>
<?php foreach ($products as $r): extract($r); ?>
    <tr>
        <td><?= $name ?></td>
        <td><?= $description ?></td>
    </tr>
<?php endforeach; ?>
</table>

<?php

$design->footer();
