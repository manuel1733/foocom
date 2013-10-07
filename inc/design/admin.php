<?php

defined('admin') or die ('no direct access');

class Design {
    public function header($title, $menu = true) {
        header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link href="inc/design/style.css" media="all" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />  -->
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>
    <body>

    <?php if ($menu): ?>
    <a href="admin.php">Start</a>
    <a href="admin.php?suppliers">Lieferanten</a>
    <a href="admin.php?vouchers">Gutscheine</a>
    <a href="admin.php?products">Produkte</a>
    <a href="admin.php?customers">Kunden</a>
    <a href="admin.php?employees">Mitarbeiter</a>
    <a href="admin.php?stores">Lager</a>
    <a href="admin.php?customers-groups">Kundengruppen</a>
    <a href="admin.php?">Labels</a>
    <a href="admin.php?producers">Hersteller</a>
    <a href="admin.php?">Produktgruppen</a>
    <a href="admin.php?">Allergene</a>
    <a href="admin.php?purchases">Einkauf Bestellung</a>
    <a href="admin.php?"></a>
    <a href="admin.php?"></a>
    <a href="admin.php?"></a>
    <a href="admin.php?"></a>

   Hallo <?= $_SESSION['auth']['name'] ?> <a href="admin.php?employees-logout">abmelden</a>

    <br />
    <?php endif; ?>

    <?php
    if (!empty($_SESSION['state_message'])) {
        echo '<div style="color: red; font-weight: bold; text-align: center;">' . $_SESSION['state_message'] . '</div>';
        $_SESSION['state_message'] = null;
    }
    ?>

    <hr>
    <br>

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
