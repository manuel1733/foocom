<?php

error_reporting(E_ALL | E_STRICT);

define('main' , true);

include 'inc/common/request.php';
include 'inc/common/database.php';
include 'inc/common/template.php';
include 'inc/designs/default/default.php';
include 'inc/config.php';

$request = new Request();
$db = new Database();
$design = new Design();

$module = $request->get_module();
include 'inc/modules/' . $module . '/' . $module . '.php';

