<?php

defined('admin') or die ('no direct access');

class Design {
    private $request;

    public function Design(Request $request) {
        $this->request = $request;
    }

    public function header($title, $menu = true) {
        header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <script src="inc/design/jquery-2.0.3.min.js"></script>

        <link href="inc/design/admin.css" media="all" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
    </head>
    <body>

    <?php if ($menu): ?>
    <div id="menu">

    <div><a href="admin.php">Start</a></div>

    <div>
        <a href="admin.php?suppliers">Lieferanten</a>
        <br />- <a href="admin.php?suppliers-receipt.php">Wareneingang</a>

    </div>

    <div>
    <a href="admin.php?products">Produkte</a>
    <br />- <a href="admin.php?products-groups">Produktgruppen</a>
    <br />- <a href="admin.php?products-allergens">Allergene</a>
    <br />- <a href="admin.php?products-labels">Labels</a>
    <br />- <a href="admin.php?producers">Hersteller</a>
    </div>


    <div><a href="admin.php?vouchers">Gutscheine</a></div>

    <div><a href="admin.php?customers">Kunden</a>
    <br />- <a href="admin.php?customers-groups">Kundengruppen</a>
    <br />- <a href="admin.php?customers-orders">Bestellungen</a>
    </div>
    <div><a href="admin.php?employees">Mitarbeiter</a>
    <br />- <a href="admin.php?employees-roles">Rollen</a>
    </div>
    <div><a href="admin.php?storages">Lager</a></div>
    <div><a href="admin.php?changes">&Auml;nderungshistory</a></div>

    <div id="user">
   Hallo <?= $_SESSION['auth']['name'] ?> <a href="admin.php?employees-logout">abmelden</a>
   </div>
    </div>

    <br style="clear: both" />


    <br />
    <hr>
    <br>

    <?php endif; ?>

    <?php
    if (!empty($_SESSION['state_message'])) {
        echo '<div style="color: red; font-weight: bold; text-align: center;">' . $_SESSION['state_message'] . '</div>';
        $_SESSION['state_message'] = null;
    }
    ?>



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
