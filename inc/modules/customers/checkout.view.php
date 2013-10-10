<?php

$design->header('Bezahlen');

?>

<?php

if (!empty($message)) {
    echo $message . '<br><br>';
}
?>

<form action="index.php?customers-checkout" method="post">
<?= $this->insert_csrf_token('customers-checkout') ?>

Lieferadresse:<br />

<?= $_SESSION['customer']['name'] ?><br>
<?= $_SESSION['customer']['addition'] ?><br>
<?= $_SESSION['customer']['street'] ?><br>
<?= $_SESSION['customer']['zipcode'] . ' ' . $_SESSION['customer']['city'] ?><br>

<br>
Rechnungsadresse:<br />

<?= $_SESSION['customer']['name'] ?><br>
<?= $_SESSION['customer']['addition'] ?><br>
<?= $_SESSION['customer']['street'] ?><br>
<?= $_SESSION['customer']['zipcode'] . ' ' . $_SESSION['customer']['city'] ?><br>

<br>
Bezahlen
<br>
<input type="radio" name="payment" value="advance" checked="checked" /> Vorauszahlung
<br>
<input type="radio" name="payment" value="cash" />Bar bei Abholung

<br>
<br>
Lieferung mit
<br>
<input type="radio" name="delivery" value="dpd" checked="checked" /> DPD
<br>
<input type="radio" name="delivery" value="post" /> Swiss Post
<br>
<input type="radio" name="delivery" value="pickup" /> Abholen (wir reservieren die Ware 1 Woche)
<br>
<br>
Kommentar
<br>
<input name="comment" size="50" />
<br>
<br>
<input type="checkbox" name="conditions" value="read" /> Die AGBs gelesen, verstanden und akzeptiert
<br>
<br>

<input type="submit" value="definitiv bestellen" />

</form>


<?php

$design->footer();
