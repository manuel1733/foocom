<?php

defined('main') or die ('no direct access');

class Design {
    private $request;

    public function Design(Request $request) {
        $this->request = $request;
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
    <?php
    $this->display_box(new Products_Groups_Box());
    $this->display_box(new Products_Allergens_Box());
    $this->display_box(new Products_Labels_Box());
    ?>
</div>

<div id="right">
    <?php
    $this->display_box(new Customers_Basket_Box());
    $this->display_box(new Customers_Customers_Box());
    ?>
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

    private function display_box($box) {
        $box->display($this->request);
    }
}
