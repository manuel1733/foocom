<?php

$design->header('Lieferanten Bestellung Schliessen');

?>

<form action="admin.php?suppliers-orders-close-<?= $id ?>" method="post">
<?= $this->insert_csrf_token('suppliers-orders-close') ?>

<h1>Lieferanten Bestellung Schliessen</h1>

Die Lieferanten Bestellung wird fuer weitere Aenderungen geschlossen.
Es koennen keine weiteren Produkte hinzugefuegt oder geloescht werden oder Aenderungen an der Menge vorgenommen werden.

<br />

<input type="submit" value="schliessen" />

</form>

<?php

$design->footer();
