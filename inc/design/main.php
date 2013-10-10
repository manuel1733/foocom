<?php

defined('main') or die ('no direct access');

include 'inc/design/db.php';

class Design {
    private $db;

    public function Design() {
        $this->db = new Design_Database();
    }

    public function header($title) {
        header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE table PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?= $title; ?></title>
        <link href="inc/design/main.css" media="all" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
    </head>
    <body>

<div id="title">
    <img src="inc/design/logo.gif" style="float:right;width:156px; height:39px;margin-left:3px;" alt="Logo" />
    <h1>Larada.org - Willkommen im online Shop der larada Genossenschaft</h1>
</div>

<div id="left" style="clear:right;">
    <p class="menutitle">Produkt Kataloge</p>

    <ul>
    <?php

    $this->display_product_groups($this->db->product_groups());

    ?>
    </ul>

    <p class="menutitle">Allergene</p>

    <ul>
    <?php

    $this->display_allergens($this->db->allergens());

    ?>
    </ul>

    <p class="menutitle">Labels</p>

    <ul>
    <?php

    $this->display_labels($this->db->labels());

    ?>
    </ul>
</div>

<div id="right">
<p class="menutitle">Warenkorb (<?= array_sum($_SESSION['customer-basket']) ?>)</p>

<?php
    if (!empty($_SESSION['customer-basket']) && is_array($_SESSION['customer-basket'])) {
        foreach ($this->db->basket($_SESSION['customer-basket']) as $r):
        ?>

        <?= $r['name'] ?> <input name="quantity" value="<?= $r['quantity'] ?>" size="2" /> <?= $r['price'] ?>

        <br  />

        <?php
        endforeach;

        echo '<a href="index.php?customers-checkout">zur Kasse</a>';
    }
?>

<br />
<br />
<br />
<br />

<p class="menutitle">Kunde</p>

<?php
if (!empty($_SESSION['customer'])) {
     echo 'Hallo ' . $_SESSION['customer']['name'] . '<br>';
}
?>


<p class="menutitle">MENU 6</p>
&raquo; <a class="menu" href="#">HYPERLINK 1</a><br />
&raquo; <a class="menu" href="#">HYPERLINK 2</a><br />
&raquo; <a class="menu" href="#">HYPERLINK 3</a><br />
&raquo; <a class="menu" href="#">HYPERLINK 4</a><br />
&raquo; <a class="menu" href="#">HYPERLINK 5</a><br />
</div>

<div id="content">

    <?php
    if (!empty($_SESSION['state_message'])) {
        echo '<div style="color: red; font-weight: bold; text-align: center;">' . $_SESSION['state_message'] . '</div>';
        $_SESSION['state_message'] = null;
    }
    ?>

 <h2><?= $title; ?></h2>


<?php
    }

    public function footer() {
?>

    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>


    <p>&nbsp;</p>
    </body>
</html>
<?php
    }

    private function display_product_groups(array $groups) {
        $length = count($groups);
        for ($i = 0; $i < $length; $i++) {
            echo '<li><a href="index.php?products-' . $groups[$i]['id'] . '-groups-' . $this->clean_name($groups[$i]['name']) . '">' . $groups[$i]['name'] . '</a>' . "\n";
            if (($i + 1) < $length && empty($groups[$i + 1]['name'])) {
                $i++;
                echo '<ul>' . "\n";
                $this->display_product_groups($groups[$i]);
                echo '</ul>' . "\n";
            }
            echo '</li>' . "\n";
        }
    }

    private function display_allergens(array $allergens) {
        foreach ($allergens as $r) {
            echo '<li><a href="index.php?products-' . $r['id'] . '-allergens-' . $this->clean_name($r['name']) . '">' . $r['name'] . '</a>' . "\n";
        }
    }

    private function display_labels(array $labels) {
        foreach ($labels as $r) {
            echo '<li><a href="index.php?products-' . $r['id'] . '-labels-' . $this->clean_name($r['name']) . '">' . $r['name'] . '</a>' . "\n";
        }
    }

    private function clean_name($name) {
        $name = preg_replace('/\xc3\xbc/', 'ue', $name);
        return preg_replace('/[^a-zA-Z-0-9]/', '', $name);
    }
}
