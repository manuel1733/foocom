<?php

include 'inc/designs/default/default.php';

class Products_view extends Template {

    public function out() {

$design = new Design();
$design->header('Produkte');
?>

<h1>Produkte</h1>

<h2>Neues Produkt anlegen</h2>
<form action="index.php?products-create" method="post">
    <input name="name" /> <input type="submit" value="anlegen" />
</form>

<table>
    <tr>
        <th>#</th>
        <td>Name</td>
    </tr>
    <?php foreach ($pdb->all() as $row): ?>
    <tr>
        <td><a href="index.php?products-change-<?php echo $row['id']; ?>">&auml;ndern</a></td>
        <td><?php echo $row['name']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php

$design->footer();

    }
}
