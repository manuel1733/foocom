<?php

defined('admin') or die ('no direct access');

$design->header('Gutscheine');

?>

<h1>Gutscheine</h1>

<form action="admin.php?vouchers" method="post">
<?= $this->insert_csrf_token('vouchers') ?>

<table>
    <tr>
        <td>Code</td>
        <td><input name="code" /></td>
    </tr>
    <tr>
        <td>Nachlass</td>
        <td><input name="discount" size="10" /> <select><option>Prozent</option><option>Betrag</option></select></td>
    </tr>
    <tr>
        <td>Beschreibung</td>
        <td><input name="description" size="50" /></td>
    </tr>
</table>

</form>

hier kann man einerseits gutschein codes erfassen
<br>
die dann auf in flyern / webseits / vortraegen / workshops vergeben werden koennen
<br>
und dann beim einkauf angegeben werden koennen
<br>
<br>
aber andererseits koennen hier auch das "produkt" gutschein gepflegt werden
<br>
also welche gutscheine gibt es wie viel kosten die wie viel rabatt bekommt man dafuer
<br>
<br>
... sicher spaeter inkl. report wer hat welchen gutschein gekauft
<br>
wer hat welchen code welchen gutschein wann eingesetzt etc.

<?php

$design->footer();