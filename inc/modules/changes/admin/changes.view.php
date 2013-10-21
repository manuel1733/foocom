<?php

$design->header('History');

?>

<h1>&Auml;nderungshistory</h1>

<table>
    <tr>
        <th>Mitarbeiter</th>
        <th>Datum / Zeit</th>
        <th>Meldung</th>
    </tr>

    <?php foreach ($changes as $r): extract($r); ?>
    <tr>
        <td><?= $employee_id; ?></td>
        <td><?= $time; ?></td>
        <td><?= $message; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<?php

$design->footer();
