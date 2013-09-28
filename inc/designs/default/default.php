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
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    </head>
    <body>

    <a href="index.php">Start</a>
    <a href="index.php?suppliers">Lieferanten</a>
    <a href="index.php?vouchers">Gutscheine</a>
    <a href="index.php?products">Produkte</a>
    <a href="index.php?customers">Kunden</a>
    <a href="index.php?">Mitarbeiter</a>
    <a href="index.php?">Lager</a>
    <a href="index.php?customers-groups">Kundengruppen</a>
    <a href="index.php?">Aktionen</a>
    <a href="index.php?">Labels</a>
    <a href="index.php?">Hersteller</a>
    <a href="index.php?">Produktgruppen</a>
    <a href="index.php?">Allergene</a>
    <a href="index.php?"></a>
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
