<?php


$design->header('Produkte');
?>

<h1>Produkte</h1>

<h2>Neues Produkt anlegen</h2>
<form action="index.php?products-create" method="post">
    <input name="name" /> <input type="submit" value="anlegen" />
</form>

<?php

$design->footer();

