<?php

$design->header('Einkauf Bestellungen');

?>

<h1>Einkauf Bestellungen</h1>

Lieferanten <select name="supplier"><?= $this->out_options($suppliers) ?></select> <input type="submit" value="Bestellung erfassen" />

<?php

$design->footer();
