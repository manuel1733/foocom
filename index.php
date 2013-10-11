<?php

error_reporting(E_ALL | E_STRICT);

define('main' , true);

include 'inc/config.php';
include 'inc/common/request.php';
include 'inc/common/database.php';
include 'inc/common/template.php';
include 'inc/common/controller.php';
include 'inc/common/autoload.php';
include 'inc/design/main.php';

$request = new Request();

include 'inc/modules/customers/session.php';

$module = $request->get_module();

$controller = new $module();
$controller->handle($request);
