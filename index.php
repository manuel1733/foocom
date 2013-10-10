<?php

error_reporting(E_ALL | E_STRICT);

define('main' , true);

include 'inc/common/request.php';
include 'inc/common/database.php';
include 'inc/common/template.php';
include 'inc/common/controller.php';
include 'inc/design/main.php';
include 'inc/config.php';

$request = new Request();

include 'inc/modules/customers/session.php';

$module = $request->get_module();

include 'inc/modules/' . $module[1] . '.php';

$controller = new $module[0]();
$controller->handle($request);
