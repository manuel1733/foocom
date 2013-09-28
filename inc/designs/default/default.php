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
    </head>
    <body>

    <a href="index.php">Start</a>
    <a href="index.php?suppliers">Lieferanten</a>

    <br />

<?php
    }


    public function footer() {
?>
    </body>
</html>
<?php
    }
}

