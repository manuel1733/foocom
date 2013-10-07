<?php

$design->header('Produkte');

?>

<h1>Produkte</h1>

<h2>Neues Produkt anlegen</h2>
<form action="admin.php?products" method="post">
    <?= $this->insert_csrf_token('products-create') ?>
    <input name="name" /> <input type="submit" value="anlegen" />
</form>

<table>
    <tr>
        <th>#</th>
        <td>Name</td>
    </tr>
    <?php foreach ($products as $row): extract($row); ?>
    <tr>
        <td><a href="admin.php?products-change-<?php echo $id; ?>">&auml;ndern</a></td>
        <td><?php echo $name; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php

$design->footer();
