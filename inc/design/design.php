<?php

defined ('main') or die ('no direct access');

class Design {
    public function header($title) {
        header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link href="inc/designs/default/style.css" media="all" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />  -->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>
    <body>

    <a href="index.php">Start</a>
    <a href="index.php?suppliers">Lieferanten</a>
    <a href="index.php?vouchers">Gutscheine</a>
    <a href="index.php?products">Produkte</a>
    <a href="index.php?customers">Kunden</a>
    <a href="index.php?">Mitarbeiter</a>
    <a href="index.php?stores">Lager</a>
    <a href="index.php?customers-groups">Kundengruppen</a>
    <a href="index.php?">Labels</a>
    <a href="index.php?producers">Hersteller</a>
    <a href="index.php?">Produktgruppen</a>
    <a href="index.php?">Allergene</a>
    <a href="index.php?purchases">Einkauf Bestellung</a>
    <a href="index.php?"></a>
    <a href="index.php?"></a>
    <a href="index.php?"></a>
    <a href="index.php?"></a>

    <br />

<?php
    }


    public function footer() {
?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </body>
</html>
<?php
    }
}
